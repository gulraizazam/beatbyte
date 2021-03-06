<?php
 
namespace App\Console\Commands;
 
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
 
class WordOfTheDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'word:day';
     
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a Daily email to all users with a word and its meaning';
     
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
     * @return mixed
     */
    public function handle()
    {
        $words = [
            'aberration' => 'a state or condition markedly different from the norm',
            'convivial' => 'occupied with or fond of the pleasures of good company',
            'diaphanous' => 'so thin as to transmit light',
            'elegy' => 'a mournful poem; a lament for the dead',
            'ostensible' => 'appearing as such but not necessarily so'
        ];
         
        // Finding a random word
        $key = array_rand($words);
        $value = $words[$key];
         
        $users = User::all();
        $pageurl = 'http://dev.music-site/user/verify/';
        foreach ($users as $user) {
            Mail::send(array(),array(),function($message) use($pageurl) {
                        $message->to('gulraizazam0@yahoo.com', "Test")
                        ->from('gulraizazam0@gmail.com')
                        ->subject("SignUp Link")
                        ->setBody($pageurl);
                    });
        }
         
        $this->info('Word of the Day sent to All Users');
    }
}