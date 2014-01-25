<?php

/**
 * This Source Code Form is subject to the terms of the Mozilla Public License, v. 2.0.
 * If a copy of the MPL was not distributed with this file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace Change\Composer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

/**
 * @name \Change\Composer\PluginInstaller
 */
class PluginInstaller extends LibraryInstaller
{
	/**
	 * {@inheritDoc}
	 */
	public function getPackageBasePath(PackageInterface $package)
	{
		$parts = explode('/', $package->getPrettyName());
		if (count($parts) != "2")
		{
			throw new \RuntimeException('Invalid package name');
		}

		$vendor = implode('', array_map(function($item){return ucfirst($item);}, explode('-', $parts[0])));
		$name = implode('', array_map(function($item){return ucfirst($item);}, explode('-', $parts[1])));


		if ($package->getType() === "rbschange-module")
		{
			return implode(DIRECTORY_SEPARATOR, ['Plugins' , 'Modules', $vendor, $name]);
		}

		if ($package->getType() === "rbschange-theme")
		{
			return implode(DIRECTORY_SEPARATOR, ['Plugins' , 'Themes', $vendor, $name]);
		}

		if ($package->getType() === "rbschange-core")
		{
			return 'Change';
		}

		if ($package->getType() === "rbschange-tests")
		{
			return 'ChangeTests';
		}

		throw new \RuntimeException('Package can not be installed');
	}

	/**
	 * {@inheritDoc}
	 */
	public function supports($packageType)
	{
		return in_array($packageType, ['rbschange-module', 'rbschange-theme', "rbschange-tests", "rbschange-core"]);
	}
} 