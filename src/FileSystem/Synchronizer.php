<?php
namespace Jlttt\Deploy\FileSystem;

class Synchronizer implements SynchronizerInterface
{
    protected $comparator;

    public function __construct(Comparator $comparator)
    {
        $this->comparator = $comparator;
    }

    public function synchronize()
    {
        $this->createFiles();
        $this->updateFiles();
        $this->deleteFiles();
    }

    private function createFiles()
    {
        foreach ($this->comparator->getCreatedFiles() as $file) {
            $file->copyTo($this->comparator->getDestination());
        }
    }

    private function updateFiles()
    {
        foreach($this->comparator->getUpdatedFiles() as $file) {
            $file->copyTo($this->comparator->getDestination());
        }
    }

    private function deleteFiles()
    {
        foreach($this->comparator->getDeletedFiles() as $file) {
            $file->delete();
        }
    }
}
