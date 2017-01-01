<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace FAPI\boilerplate\tests;

use FAPI\Boilerplate\HttpClientConfigurator;
use Http\Client\Common\Plugin\HeaderAppendPlugin;
use Nyholm\NSA;

final class HttpClientConfiguratorTest extends \PHPUnit_Framework_TestCase
{
    public function testAppendPlugin()
    {
        $hcc = new HttpClientConfigurator();
        $plugin0 = new HeaderAppendPlugin(['plugin0']);

        $hcc->appendPlugin($plugin0);
        $plugins = NSA::getProperty($hcc, 'appendPlugins');
        $this->assertCount(1, $plugins);
        $this->assertEquals($plugin0, $plugins[0]);

        $plugin1 = new HeaderAppendPlugin(['plugin1']);
        $hcc->appendPlugin($plugin1);
        $plugins = NSA::getProperty($hcc, 'appendPlugins');
        $this->assertCount(2, $plugins);
        $this->assertEquals($plugin1, $plugins[1]);
    }

    public function testAppendPluginMultiple()
    {
        $hcc = new HttpClientConfigurator();
        $plugin0 = new HeaderAppendPlugin(['plugin0']);
        $plugin1 = new HeaderAppendPlugin(['plugin1']);

        $hcc->appendPlugin($plugin0, $plugin1);
        $plugins = NSA::getProperty($hcc, 'appendPlugins');
        $this->assertCount(2, $plugins);
        $this->assertEquals($plugin0, $plugins[0]);
        $this->assertEquals($plugin1, $plugins[1]);
    }

    public function testPrependPlugin()
    {
        $hcc = new HttpClientConfigurator();
        $plugin0 = new HeaderAppendPlugin(['plugin0']);

        $hcc->prependPlugin($plugin0);
        $plugins = NSA::getProperty($hcc, 'prependPlugins');
        $this->assertCount(1, $plugins);
        $this->assertEquals($plugin0, $plugins[0]);

        $plugin1 = new HeaderAppendPlugin(['plugin1']);
        $hcc->prependPlugin($plugin1);
        $plugins = NSA::getProperty($hcc, 'prependPlugins');
        $this->assertCount(2, $plugins);
        $this->assertEquals($plugin1, $plugins[0]);
    }

    public function testPrependPluginMultiple()
    {
        $hcc = new HttpClientConfigurator();
        $plugin0 = new HeaderAppendPlugin(['plugin0']);
        $plugin1 = new HeaderAppendPlugin(['plugin1']);

        $hcc->prependPlugin($plugin0, $plugin1);
        $plugins = NSA::getProperty($hcc, 'prependPlugins');
        $this->assertCount(2, $plugins);
        $this->assertEquals($plugin0, $plugins[0]);
        $this->assertEquals($plugin1, $plugins[1]);
    }
}
