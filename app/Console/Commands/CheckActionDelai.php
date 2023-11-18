<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Processuse;
use App\Models\Objectif;
use App\Models\Resva;
use App\Models\Risque;
use App\Models\Cause;
use App\Models\Rejet;
use App\Models\Action;
use App\Models\Suivi_action;
use App\Models\Poste;
use App\Models\User;
use App\Models\Amelioration;

use App\Events\ActionDelai;

use Carbon\Carbon;


class CheckActionDelai extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:CheckActionDelai';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(ActionDelai $event)
    {
        $currentDate = now()->format('Y-m-d');

        $action = Action::where('delai', '==' ,$currentDate)->count();

        if ($action >= 1) {
            event(new ActionDelai());
        }

    }
}
