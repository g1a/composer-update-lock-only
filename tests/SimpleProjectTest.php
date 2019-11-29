<?php
namespace ComposerUpdateLockOnly;

use PHPUnit\Framework\TestCase;

class UpdateLockTest extends TestCase
{
    use Fixtures;
    use RunComposer;

    /**
     * testExampleA starts with an example project that contains a default
     * scenario and one other scenario, and ensures that the alternate scenario
     * can be created and installed.
     */
    public function testUpdateLock()
    {
        // Create the project directory to work with
        $testProjectDir = $this->createTestProject('simple-project');

        // Run 'composer install' to set up our path repository
        list($output, $status) = $this->composer('install', $testProjectDir);
        $this->assertRegExp('#Installing g1a/composer-update-lock-only[^:]*: Symlinking from#', $output);
        $this->assertNotContains('Your requirements could not be resolved to an installable set of packages.', $output);
        $this->assertEquals(0, $status);

        // Read the composer.json file
        $composer_json = json_decode(file_get_contents($testProjectDir . '/composer.json'), true);
        $this->assertNotEmpty($composer_json);

        // Allow composer/semver to be upgradable to 1.4.x
        $composer_json['require']['composer/semver'] = '^1.4';
        file_put_contents($testProjectDir . '/composer.json', json_encode($composer_json));

        // Run 'composer update:lock-only' to upgrade the composer/semver project
        list($output, $status) = $this->composer('update:lock-only', $testProjectDir);
        $this->assertRegExp('#Updating composer/semver \(1.0.0\) to composer/semver \(1.[0-9].[0-9]\)#', $output);
        $this->assertEquals(0, $status);

        // Make sure that 'vendor' was not updated
        $changelog = file_get_contents($testProjectDir . '/vendor/composer/semver/CHANGELOG.md');
        $this->assertContains('1.0.0', $changelog);
        $this->assertNotContains('1.2.0', $changelog);
    }
}
