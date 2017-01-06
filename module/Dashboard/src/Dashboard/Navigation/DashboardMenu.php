<?php

/**
 * Description of DashboardMenu
 *
 * @author fragote
 */
namespace Dashboard\Navigation;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Navigation\Service\DefaultNavigationFactory;
use Zend\Authentication\AuthenticationService;
use Dashboard\Helper\RouteHelper;

class DashboardMenu extends DefaultNavigationFactory
{
    protected function getPages(\Interop\Container\ContainerInterface  $serviceLocator)
    {
        $menu = array();
        if (null == $this->pages) {
            $auth = new AuthenticationService();
            $mvcEvent = $serviceLocator->get('Application')->getMvcEvent();
            $privilegeMenu = $serviceLocator->get('Dashboard\Model\PrivilegeTable');

            $identity = $auth->getIdentity();
            $dataMenu = $privilegeMenu->getMenuByUser($identity->id);

            $routeMatch = $mvcEvent->getRouteMatch();
            $router = $mvcEvent->getRouter();
            $controllerName = $routeMatch->getParam('controller','index');
            $menu = $this->menuFormat($dataMenu,$controllerName);

            $pages = $this->getPagesFromConfig($menu);
            $this->pages = $this->injectComponents($pages, $routeMatch, $router);
        }

        return $this->pages;
    }

    public function menuFormat($dataMenu,$controllerName)
    {
        $controller = strtolower(array_pop(explode('\\', $controllerName)));
        $menu = array();
        $routHelper = new RouteHelper();
        foreach ($dataMenu as $opt) {
            if (empty($opt['parent'])) {
                $menu[$opt['menu_id']] = array(
                    'icon'  => $opt['icon'],
                    'label' => $opt['label'],
                    'uri' => $routHelper->formUrl($opt['module'], $opt['controller'], $opt['action'])
                );
            }else {
                if($controller == $opt['controller']){
                    $menu[$opt['parent']]['current'] = true;
                }
                $menu[$opt['parent']]['pages'][] = array(
                    'icon'    => $opt['icon'],
                    'label'   => $opt['label'],
                    'uri'     => $routHelper->formUrl($opt['module'], $opt['controller'], $opt['action'])
                );
            }
        }
        //Logout
        $menu[] = array(
            'label' => 'Logout',
            'uri' => '/dashboard/logout',
            'icon' => 'power-off'
        );
        return $menu;
    }
}
