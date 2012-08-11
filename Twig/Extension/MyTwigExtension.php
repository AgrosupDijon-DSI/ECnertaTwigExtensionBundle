<?php

namespace ECnerta\Bundle\TwigExtensionBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\FormView;

class MyTwigExtension extends \Twig_Extension {

    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    /**
     * @inherited
     */
    public function getFilters() {
        return array(
            'classMethodes' => new \Twig_Filter_Method($this, 'twig_classmethodes_filter'),
            'vardump' => new \Twig_Filter_Method($this, 'twig_vardump_filter'),
            'printr' => new \Twig_Filter_Method($this, 'twig_printr_filter'),
            'float' => new \Twig_Filter_Method($this, 'twig_float_filter'),
            'shuffle' => new \Twig_Filter_Method($this, 'twig_filtre_shuffle')
        );
    }

    /**
     * @inherited
     */
    public function getFunctions() {
        return array(
            'current_route_is' => new \Twig_Function_Method($this, 'currentRouteIs'),
            'param' => new \Twig_Function_Method($this, 'param'),
        );
    }

    /**
     * @inherited
     */
    public function getName() {
        return 'bodTwigExt';
    }

    /**
     * Transforme une chaine en float
     *
     * @param \Twig_Environment $env
     * @param mixed $value
     */
    public function twig_float_filter($value) {
        $aFloat = floatval($value);

        if (count(($tab = explode(".", $aFloat))) >= 2) {
            if ($tab[1] >= 100) {
                return number_format($aFloat, 3, ',', '');
            } else {
                return number_format($aFloat, 2, ',', '');
            }
        }

        return $aFloat;
    }

    /**
     * Affiche le contenue de la variable $value avec un print_r et met fin à l'exécution du script.
     *
     * @param \Twig_Environment $env
     * @param mixed $value
     */
    public function twig_printr_filter($value, $exitOrNot = TRUE) {
        ob_start();

        echo "<pre>";
        print_r($value);
        echo "</pre>";
        if ($exitOrNot) {
            echo ob_get_clean();
            exit;
        }
        return ob_get_clean();
    }

    /**
     * Affiche le contenue de la variable $value avec un var_dump et met fin à l'exécution du script.
     *
     * @param \Twig_Environment $env
     * @param mixed $value
     */
    public function twig_vardump_filter($value, $exitOrNot = TRUE) {
        ob_start();

        echo "<pre>";
        var_dump($value);
        echo "</pre>";
        if ($exitOrNot) {
            echo ob_get_clean();
            exit;
        }
        return ob_get_clean();
    }

    public function twig_filtre_shuffle(array $value) {
        shuffle($value);
        return $value;
    }

    public function twig_classmethodes_filter($value, $exitOrNot = TRUE) {
        ob_start();

        echo "<pre>";
        print_r(get_class_methods($value));
        echo "</pre>";
        if ($exitOrNot) {
            echo ob_get_clean();
            exit;
        }
        return ob_get_clean();
    }

    /**
     * Permet de savoir si le(s) lien(s) passé en paramètre est celui en cours d'utilisations
     *
     * @param array/string $routes
     * @param type $parameters
     * @return boolean
     */
    public function currentRouteIs($routes, $parameters = array()) {
        $test = FALSE;

        if (!is_array($routes)) {
            $routes = array($routes);
        }

        $request = $this->container->get('request');

        foreach ($routes as $route) {
            if ($request->attributes->get('_route') == $route) {
                if (count($parameters) > 0) {
                    foreach ($parameters as $name => $value) {
                        if ($request->attributes->get($name) === $value) {
                            $test = TRUE;
                        }
                    }
                } else {
                    $test = TRUE;
                }
            }
        }

        return $test;
    }

    /**
     * Retourne un paramètre contenue dans le parameterBag
     * @param string $paramName
     * @return string
     */
    public function param($paramName) {

        if ($this->container->hasParameter($paramName)) {
            return $this->container->getParameter($paramName);
        } else {
            throw new \InvalidArgumentException($paramName . " dosen't exist");
        }
    }

}
