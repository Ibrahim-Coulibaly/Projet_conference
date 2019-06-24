<?php

use Symfony\Component\Routing\Matcher\Dumper\CompiledUrlMatcherTrait;
use Symfony\Component\Routing\RequestContext;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class srcApp_KernelDevDebugContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    use CompiledUrlMatcherTrait;

    public function __construct(RequestContext $context)
    {
        $this->context = $context;
        $this->staticRoutes = [
            '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
            '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
            '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
            '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
            '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
            '/ajax/active' => [[['_route' => 'ajax_active', '_controller' => 'App\\Controller\\AjaxController::active'], null, null, null, false, false, null]],
            '/ajax/mail' => [[['_route' => 'ajax_mail', '_controller' => 'App\\Controller\\AjaxController::sendMAil'], null, null, null, false, false, null]],
            '/ajax/result' => [[['_route' => 'ajax_result', '_controller' => 'App\\Controller\\AjaxController::result'], null, null, null, false, false, null]],
            '/index' => [[['_route' => 'article_index', '_controller' => 'App\\Controller\\ArticleController::index'], null, ['GET' => 0], null, true, false, null]],
            '/game' => [[['_route' => 'game', '_controller' => 'App\\Controller\\GameController::index'], null, null, null, false, false, null]],
            '/game/play' => [[['_route' => 'game_play', '_controller' => 'App\\Controller\\GameController::play'], null, null, null, false, false, null]],
            '/game/run' => [[['_route' => 'game_run', '_controller' => 'App\\Controller\\GameController::run'], null, null, null, false, false, null]],
            '/account' => [[['_route' => 'account_show', '_controller' => 'App\\Controller\\GameController::userGame'], null, null, null, false, false, null]],
            '/register' => [[['_route' => 'app_register', '_controller' => 'App\\Controller\\RegistrationController::register'], null, null, null, false, false, null]],
            '/login' => [[['_route' => 'app_login', '_controller' => 'App\\Controller\\SecurityController::login'], null, null, null, false, false, null]],
            '/logout' => [[['_route' => 'app_logout', '_controller' => 'App\\Controller\\SecurityController::logout'], null, ['GET' => 0], null, false, false, null]],
            '/forgotten_password' => [[['_route' => 'app_forgotten_password', '_controller' => 'App\\Controller\\SecurityController::forgottenPassword'], null, null, null, false, false, null]],
            '/admin' => [[['_route' => 'easyadmin', '_controller' => 'EasyCorp\\Bundle\\EasyAdminBundle\\Controller\\EasyAdminController::indexAction'], null, null, null, true, false, null]],
            '/' => [[['_route' => 'index', '_controller' => 'App\\Controller\\ArticleController::index'], null, null, null, false, false, null]],
        ];
        $this->regexpList = [
            0 => '{^(?'
                    .'|/_(?'
                        .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                        .'|wdt/([^/]++)(*:57)'
                        .'|profiler/([^/]++)(?'
                            .'|/(?'
                                .'|search/results(*:102)'
                                .'|router(*:116)'
                                .'|exception(?'
                                    .'|(*:136)'
                                    .'|\\.css(*:149)'
                                .')'
                            .')'
                            .'|(*:159)'
                        .')'
                    .')'
                    .'|/index/([^/]++)(*:184)'
                    .'|/comment/([^/]++)(*:209)'
                    .'|/r(?'
                        .'|eset_password/([^/]++)(*:244)'
                        .'|ss(?:/([^/]++))?(*:268)'
                    .')'
                    .'|/stream/(rss|atom|json)/([^/]++)(*:309)'
                    .'|/atom(?:/([^/]++))?(*:336)'
                    .'|/json(?:/([^/]++))?(*:363)'
                    .'|/mock/rss(?:/([^/]++))?(*:394)'
                .')/?$}sDu',
        ];
        $this->dynamicRoutes = [
            38 => [[['_route' => '_twig_error_test', '_controller' => 'twig.controller.preview_error::previewErrorPageAction', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
            57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
            102 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
            116 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
            136 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception::showAction'], ['token'], null, null, false, false, null]],
            149 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception::cssAction'], ['token'], null, null, false, false, null]],
            159 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
            184 => [[['_route' => 'article_show', '_controller' => 'App\\Controller\\ArticleController::show'], ['id'], null, null, false, true, null]],
            209 => [[['_route' => 'comment_show', '_controller' => 'App\\Controller\\CommentController::show'], ['id'], ['GET' => 0], null, false, true, null]],
            244 => [[['_route' => 'app_reset_password', '_controller' => 'App\\Controller\\SecurityController::resetPassword'], ['token'], null, null, false, true, null]],
            268 => [[['_route' => 'feed_rss', '_controller' => 'Debril\\RssAtomBundle\\Controller\\StreamController::indexAction', 'format' => 'rss', 'id' => null], ['id'], null, null, false, true, null]],
            309 => [[['_route' => 'feed_stream', '_controller' => 'Debril\\RssAtomBundle\\Controller\\StreamController::indexAction', 'format' => 'rss'], ['format', 'id'], null, null, false, true, null]],
            336 => [[['_route' => 'feed_atom', '_controller' => 'Debril\\RssAtomBundle\\Controller\\StreamController::indexAction', 'format' => 'atom', 'id' => null], ['id'], null, null, false, true, null]],
            363 => [[['_route' => 'feed_json', '_controller' => 'Debril\\RssAtomBundle\\Controller\\StreamController::indexAction', 'format' => 'json', 'id' => null], ['id'], null, null, false, true, null]],
            394 => [
                [['_route' => 'feed_mock', '_controller' => 'Debril\\RssAtomBundle\\Controller\\StreamController::indexAction', 'format' => 'rss', 'id' => null], ['id'], null, null, false, true, null],
                [null, null, null, null, false, false, 0],
            ],
        ];
    }
}
