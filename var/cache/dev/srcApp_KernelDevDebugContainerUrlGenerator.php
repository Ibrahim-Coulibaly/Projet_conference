<?php

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Psr\Log\LoggerInterface;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class srcApp_KernelDevDebugContainerUrlGenerator extends Symfony\Component\Routing\Generator\UrlGenerator
{
    private static $declaredRoutes;
    private $defaultLocale;

    public function __construct(RequestContext $context, LoggerInterface $logger = null, string $defaultLocale = null)
    {
        $this->context = $context;
        $this->logger = $logger;
        $this->defaultLocale = $defaultLocale;
        if (null === self::$declaredRoutes) {
            self::$declaredRoutes = [
        '_twig_error_test' => [['code', '_format'], ['_controller' => 'twig.controller.preview_error::previewErrorPageAction', '_format' => 'html'], ['code' => '\\d+'], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '\\d+', 'code', true], ['text', '/_error']], [], []],
        '_wdt' => [['token'], ['_controller' => 'web_profiler.controller.profiler::toolbarAction'], [], [['variable', '/', '[^/]++', 'token', true], ['text', '/_wdt']], [], []],
        '_profiler_home' => [[], ['_controller' => 'web_profiler.controller.profiler::homeAction'], [], [['text', '/_profiler/']], [], []],
        '_profiler_search' => [[], ['_controller' => 'web_profiler.controller.profiler::searchAction'], [], [['text', '/_profiler/search']], [], []],
        '_profiler_search_bar' => [[], ['_controller' => 'web_profiler.controller.profiler::searchBarAction'], [], [['text', '/_profiler/search_bar']], [], []],
        '_profiler_phpinfo' => [[], ['_controller' => 'web_profiler.controller.profiler::phpinfoAction'], [], [['text', '/_profiler/phpinfo']], [], []],
        '_profiler_search_results' => [['token'], ['_controller' => 'web_profiler.controller.profiler::searchResultsAction'], [], [['text', '/search/results'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
        '_profiler_open_file' => [[], ['_controller' => 'web_profiler.controller.profiler::openAction'], [], [['text', '/_profiler/open']], [], []],
        '_profiler' => [['token'], ['_controller' => 'web_profiler.controller.profiler::panelAction'], [], [['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
        '_profiler_router' => [['token'], ['_controller' => 'web_profiler.controller.router::panelAction'], [], [['text', '/router'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
        '_profiler_exception' => [['token'], ['_controller' => 'web_profiler.controller.exception::showAction'], [], [['text', '/exception'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
        '_profiler_exception_css' => [['token'], ['_controller' => 'web_profiler.controller.exception::cssAction'], [], [['text', '/exception.css'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
        'ajax_active' => [[], ['_controller' => 'App\\Controller\\AjaxController::active'], [], [['text', '/ajax/active']], [], []],
        'ajax_mail' => [[], ['_controller' => 'App\\Controller\\AjaxController::sendMAil'], [], [['text', '/ajax/mail']], [], []],
        'ajax_result' => [[], ['_controller' => 'App\\Controller\\AjaxController::result'], [], [['text', '/ajax/result']], [], []],
        'article_index' => [[], ['_controller' => 'App\\Controller\\ArticleController::index'], [], [['text', '/index/']], [], []],
        'article_show' => [['id'], ['_controller' => 'App\\Controller\\ArticleController::show'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/index']], [], []],
        'comment_show' => [['id'], ['_controller' => 'App\\Controller\\CommentController::show'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/comment']], [], []],
        'game' => [[], ['_controller' => 'App\\Controller\\GameController::index'], [], [['text', '/game']], [], []],
        'game_play' => [[], ['_controller' => 'App\\Controller\\GameController::play'], [], [['text', '/game/play']], [], []],
        'game_run' => [[], ['_controller' => 'App\\Controller\\GameController::run'], [], [['text', '/game/run']], [], []],
        'account_show' => [[], ['_controller' => 'App\\Controller\\GameController::userGame'], [], [['text', '/account']], [], []],
        'app_register' => [[], ['_controller' => 'App\\Controller\\RegistrationController::register'], [], [['text', '/register']], [], []],
        'app_login' => [[], ['_controller' => 'App\\Controller\\SecurityController::login'], [], [['text', '/login']], [], []],
        'app_logout' => [[], ['_controller' => 'App\\Controller\\SecurityController::logout'], [], [['text', '/logout']], [], []],
        'app_forgotten_password' => [[], ['_controller' => 'App\\Controller\\SecurityController::forgottenPassword'], [], [['text', '/forgotten_password']], [], []],
        'app_reset_password' => [['token'], ['_controller' => 'App\\Controller\\SecurityController::resetPassword'], [], [['variable', '/', '[^/]++', 'token', true], ['text', '/reset_password']], [], []],
        'easyadmin' => [[], ['_controller' => 'EasyCorp\\Bundle\\EasyAdminBundle\\Controller\\EasyAdminController::indexAction'], [], [['text', '/admin/']], [], []],
        'feed_stream' => [['format', 'id'], ['_controller' => 'Debril\\RssAtomBundle\\Controller\\StreamController::indexAction', 'format' => 'rss'], ['format' => 'rss|atom|json'], [['variable', '/', '[^/]++', 'id', true], ['variable', '/', 'rss|atom|json', 'format', true], ['text', '/stream']], [], []],
        'feed_rss' => [['id'], ['_controller' => 'Debril\\RssAtomBundle\\Controller\\StreamController::indexAction', 'format' => 'rss', 'id' => null], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/rss']], [], []],
        'feed_atom' => [['id'], ['_controller' => 'Debril\\RssAtomBundle\\Controller\\StreamController::indexAction', 'format' => 'atom', 'id' => null], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/atom']], [], []],
        'feed_json' => [['id'], ['_controller' => 'Debril\\RssAtomBundle\\Controller\\StreamController::indexAction', 'format' => 'json', 'id' => null], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/json']], [], []],
        'feed_mock' => [['id'], ['_controller' => 'Debril\\RssAtomBundle\\Controller\\StreamController::indexAction', 'format' => 'rss', 'id' => null], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/mock/rss']], [], []],
        'index' => [[], ['_controller' => 'App\\Controller\\ArticleController::index'], [], [['text', '/']], [], []],
    ];
        }
    }

    public function generate($name, $parameters = [], $referenceType = self::ABSOLUTE_PATH)
    {
        $locale = $parameters['_locale']
            ?? $this->context->getParameter('_locale')
            ?: $this->defaultLocale;

        if (null !== $locale && null !== $name) {
            do {
                if ((self::$declaredRoutes[$name.'.'.$locale][1]['_canonical_route'] ?? null) === $name) {
                    unset($parameters['_locale']);
                    $name .= '.'.$locale;
                    break;
                }
            } while (false !== $locale = strstr($locale, '_', true));
        }

        if (!isset(self::$declaredRoutes[$name])) {
            throw new RouteNotFoundException(sprintf('Unable to generate a URL for the named route "%s" as such route does not exist.', $name));
        }

        list($variables, $defaults, $requirements, $tokens, $hostTokens, $requiredSchemes) = self::$declaredRoutes[$name];

        return $this->doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $referenceType, $hostTokens, $requiredSchemes);
    }
}
