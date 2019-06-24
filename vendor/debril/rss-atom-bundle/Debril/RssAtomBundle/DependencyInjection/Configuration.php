<?php declare(strict_types=1);

namespace Debril\RssAtomBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder() : TreeBuilder
    {
        $treeBuilder = new TreeBuilder();

        $treeBuilder->root('debril_rss_atom')
                ->children()
                    ->booleanNode('private')
                        ->info('Change cache headers so the RSS feed is not cached by public caches (like reverse-proxies...).')
                        ->defaultValue(false)
                    ->end()
                    ->booleanNode('force_refresh')
                        ->info('Do not send 304 status if the feed has not been modified since last hit')
                        ->defaultValue(false)
                    ->end()
                    ->scalarNode('content_type_json')
                        ->info('Content-Type header value to use for json feed generation.')
                        ->defaultValue('application/json')
                    ->end()
                    ->scalarNode('content_type_xml')
                        ->info('Content-Type header value to use for xml feed generation (atom and rss).')
                        ->defaultValue('application/xhtml+xml')
                    ->end()
                    ->arrayNode('date_formats')
                        ->prototype('scalar')->end()
                    ->end()
                ->end()
        ;

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.
        return $treeBuilder;
    }
}
