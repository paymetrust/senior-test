<?php
namespace Domain\Events\Tests\Adapters;

use DateTime;
use DateTimeInterface;
use Domain\Events\Entity\Events;
use Domain\Events\Entity\Users;
use Domain\Events\Port\IEventsRepository;

use PDO;
use PHPUnit\Framework\Constraint\IsInstanceOf;

class PdoEventsRepository implements IEventsRepository{

    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=PostgreSQLdb;charset=utf8;','quitus','admin',[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
        
    }

    public function save(Events $event)
    {
        //dd($user);
        $sql ='INSERT INTO events SET name = :name, 
                                      edate = :edate, 
                                      etime = :etime, 
                                      ville = :ville, 
                                      emplacement = :emplacement, 
                                      prix = :prix, 
                                      createdAt = :createdAt,
                                      uuid = :uuid';
        $query = $this->pdo->prepare($sql);

        $query->execute([
                          'name' => $event->name,
                          'edate' => $event->edate->format('Y-m-d H:i:s'),
                          'etime' => $event->etime->format('H:i'),
                          'ville' => $event->ville,
                          'emplacement' => $event->emplacement,
                          'prix' => $event->prix,
                          'createdAt' =>$event->createdAt? $event->createdAt->format('Y-m-d H:i:s'):null,
                          'uuid' => $event->uuid,
                          
                          ]);
    }

    public function findOneEvent(string $uuid): ?Events
    {
        $sql ='SELECT e.*  FROM events e WHERE e.uuid = :uuid LIMIT 0,1';
        $query = $this->pdo->prepare($sql);

        $query->execute([
            'uuid' => $uuid
        ]);

        $result = $query->fetch(PDO::FETCH_ASSOC);

        if(!$result){
           return null;
        }
        //dd($result);
        //dd($result['createdAt']);
        //$date = date('Y-m-d H:i:s');
        $events = new Events($result['name'],
                          $result['edate'] ? new DateTime($result['edate']):null,
                          $result['etime'] ? new DateTime($result['etime']):null,
                          $result['ville'],
                          $result['emplacement'],
                          $result['prix'],
                          $result['createdAt']? new DateTime($result['createdAt']):null,
                          $result['uuid']);
                          

        return $events;
    }
   
    public function findSearchEvent(string $ville, DateTimeInterface $edate): ?Events
    {
         $sql ='SELECT e.*  FROM events e WHERE e.ville = :ville AND e.edate = :edate';
         //dd($sql);
        $query = $this->pdo->prepare($sql);
        //dd($edate);
        //$edate  = $edate->format('Y-m-d');
        $query->execute([
            'ville' => $ville,
            'edate' => $edate->format('Y-m-d')
        ]);

        $result = $query->fetch(PDO::FETCH_ASSOC);

        if(!$result){
           return null;
        }
        //dd($result);
        //dd($result['createdAt']);
        //$date = date('Y-m-d H:i:s');
        $events = new Events($result['name'],
                          new DateTime($result['edate']),
                          new DateTime($result['etime']),
                          $result['ville'],
                          $result['emplacement'],
                          $result['prix'],
                          $result['createdAt']? new DateTime($result['createdAt']):null,
                          $result['uuid']);

        return $events;
    }
    
   
}