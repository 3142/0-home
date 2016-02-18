<?php

/*
 * This file is a part of Sculpin.
 *
 * (c) Dragonfly Development Inc.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rocketage\Sculpin\Bundle\MultilingualBundle;

use Sculpin\Core\Sculpin;
use Sculpin\Core\Event\SourceSetEvent;
use Sculpin\Core\Source\SourceInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Sculpin\Core\Permalink\Permalink;

/**
 * Multilingual Generator.
 */
class MultilingualGenerator implements EventSubscriberInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            Sculpin::EVENT_BEFORE_RUN => 'beforeRun',
        );
    }

    /**
     * @todo: Move target and global dir details into sculpin config
     *
     * @param SourceSetEvent $sourceSetEvent
     */
    public function beforeRun(SourceSetEvent $sourceSetEvent)
    {
        $sourceSet = $sourceSetEvent->sourceSet();

        $targets = ['en', 'es'];

        foreach ($sourceSet->updatedSources() as $source) {

            $sourcePath = $source->relativePathname();

            if ($source->isGenerated() || (strpos($sourcePath, 'global') !== 0)) {
                echo 'Skipping: ', $sourcePath, PHP_EOL;
                continue;
            }

            foreach ($targets as $target) {

                $targetPath = str_replace('global', $target, $sourcePath);
                $id = $source->sourceId() . ':' . $target;

                $generatedSource = $source->duplicate($id, ['relativePathname' => $targetPath]);
                $generatedSource->setIsGenerated();
                $sourceSet->mergeSource($generatedSource);

            }

            $source->setShouldBeSkipped();
        }
    }
}
