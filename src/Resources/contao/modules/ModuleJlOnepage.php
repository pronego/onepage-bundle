<?php

class ModuleJlOnepage extends \Module {

    protected $strTemplate = 'mod_jl-onepage-nav';
    protected function compile()
    {
        global $objPage;
        if($this->rootPage){
            $Articles=\Contao\ArticleModel::findByPid($this->rootPage, array('order'=>'sorting'));
            $rootPageId=\Contao\PageModel::findById($this->rootPage);
            $this->Template->uri = $rootPageId->getFrontendUrl('');
        } else{
            $Articles=\Contao\ArticleModel::findByPid($objPage->id, array('order'=>'sorting'));
            $urlGenerator=\Contao\System::getContainer()->get('contao.routing.url_generator');
            $this->Template->uri = $url=$urlGenerator->generate($objPage->alias);
        }

        if($this->loadDefaultJavascript){
            //$GLOBALS['TL_JAVASCRIPT'][] = 'bundles/wronepage/Scroller.min.js';
            //$GLOBALS['TL_JAVASCRIPT'][] = 'bundles/wronepage/Onepage.min.js';
            $GLOBALS['TL_BODY'][] = '<script src="bundles/jlonepagenav/Scroller.min.js"></script>';
            $GLOBALS['TL_BODY'][] = '<script src="bundles/jlonepagenav/Onepage.min.js"></script>';
        }
        
        
        $Pages = \Contao\PageModel::findAll();
        $arrPages = array();
        
         foreach($Pages as $page){
        	$articles=\Contao\ArticleModel::findByPid($page->id, array('order'=>'sorting'));
        	$page_articles = array();
        	if(!is_null($articles)){
        		while($articles->next()){
        			if(strlen($articles->in_onepage && $articles->published)){
                		array_push($page_articles,
                    		array(
                        	'title'=>$articles->title,
                        	'alias'=> $articles->alias
                    		)
                		);
            		}
        		}
        	}
        	if($page_articles != array()){
            	array_push($arrPages, 
            		array(
            		'title' => $page->pageTitle, 
            		'uri' => $page->getFrontendUrl(''),
            		'articles' => $page_articles)
            	);
            }
        }
        /*
        
        foreach($Pages as $page){
        	$articles=\Contao\ArticleModel::findByPid($page->id, array('order'=>'sorting'));
        	$page_articles = array();
        	foreach($articles as $article){
        		if(strlen($article->in_onepage && $article->published)){
        		print_r($article);
                	array_push($page_articles,
                    	array(
                        	'title'=>$article->title,
                        	'alias'=> $article->alias
                    	)
                	);
            	}
        	}
        	if($page_articles != array()){
            	array_push($arrPages, 
            		array(
            		'title' => $page->pageTitle, 
            		'uri' => $page->getFrontendUrl(''),
            		'articles' => $page_articles)
            	);
            }
        }
        */
        

        $this->Template->request = ampersand(\Environment::get('indexFreeRequest'));
        $this->Template->skipId = 'skipNavigation' . $this->id;
        $this->Template->loadStandartJavascipt = $this->loadDefaultJavascript;
        $this->Template->arrPages = $arrPages;
    }
}