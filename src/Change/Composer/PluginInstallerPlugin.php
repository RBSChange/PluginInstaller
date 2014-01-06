<?php

/**
 * This Source Code Form is subject to the terms of the Mozilla Public License, v. 2.0.
 * If a copy of the MPL was not distributed with this file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace Change\Composer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class PluginInstallerPlugin implements  PluginInterface
{
	public function activate(Composer $composer, IOInterface $io)
	{
		$installer = new \Change\Composer\PluginInstaller($io, $composer);
		$composer->getInstallationManager()->addInstaller($installer);
	}
}