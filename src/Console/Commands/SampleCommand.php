<?php

namespace Pivlu\SamplePackage\Console\Commands;

use Illuminate\Console\Command;

class SampleCommand extends Command
{
   protected $signature = 'sample-package:example'; // The command that user uses and run.
   protected $description = 'An example command description for SamplePackage.';

   public function handle()
   {
      
      $this->info('Hello from SamplePackage command!');
   }
}