<?php

class ModuleJlOnepage extends \Module {

    protected $strTemplate = 'mod_jl-onepage-nav';
	//protected $strTemplate = 'mod_jl-onepage-nav-special';
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
            //$GLOBALS['TL_BODY'][] = '<script src="bundles/jlonepagenav/Scroller.min.js"></script>';
            //$GLOBALS['TL_BODY'][] = '<script src="bundles/jlonepagenav/Onepage.min.js"></script>';
			//$GLOBALS['TL_BODY'][] = '<script src="bundles/jlonepagenav/smoothscrolling.js"></script>';
        }
        
        
        //$Pages = \Contao\PageModel::findAll();
		$RootPage = \Contao\PageModel::findOneBy('type', 'root');
		$Pages = \Contao\PageModel::findByPid($RootPage->id);
		//print_r($Pages);
        $arrPages = array();
         foreach($Pages as $page){
        	$articles=\Contao\ArticleModel::findByPid($page->id, array('order'=>'sorting'));
        	$subPages = \Contao\PageModel::findByPid($page->id, array('order'=>'sorting'));

        	$page_articles = array(array());
        	$i = 0;

			 if(!is_null($subPages)){

				 while($subPages->next()){
					 if(strlen($subPages->in_onepage) && strlen($subPages->published)){
						 $page_articles[$i][] =
							 array(
								 'title'=> $subPages->title,
								 'alias'=> $subPages->alias,
								 'uri' => '/'.$subPages->alias.'.html',
							 );
						 $page_articles[$i]['subarticles'] = array();
						 $i = $i+1;
					 }

				 }
			 }

        	if(!is_null($articles)){

        		while($articles->next()){
        			if(strlen($articles->in_onepage && $articles->published)){

        				if(!$articles->in_onepage_level_lower){
							$page_articles[$i][] =
								array(
									'title'=> $articles->title,
									'alias'=> $articles->alias,
									'uri'=>$page->getFrontendUrl('').'#'.$articles->alias,
								);
							$page_articles[$i]['subarticles'] = array();
							$i = $i+1;

						}elseif($i > 0){
							$page_articles[$i-1]['subarticles'][] =
								array(
									'title'=> $articles->title,
									'alias'=> $articles->alias,
									'uri'=>$page->getFrontendUrl('').'#'.$articles->alias,
								);
						}

            		}

        		}
        	}

        	if($page_articles != array(array()) OR strlen($page->in_onepage)){
            	array_push($arrPages, 
            		array(
            			'title' => $page->title,
            			'uri' => $page->getFrontendUrl(''),
            			'articles' => $page_articles,
						'alias' => $page->alias,
						'id' => $page->id)
            	);
            }
        }
        

        $this->Template->request = ampersand(\Environment::get('indexFreeRequest'));
        $this->Template->skipId = 'skipNavigation' . $this->id;
        $this->Template->loadStandartJavascipt = $this->loadDefaultJavascript;
        $this->Template->arrPages = $arrPages;
    }
}