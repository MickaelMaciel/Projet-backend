<?php

namespace App\DataFixtures;

use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends BaseFixture
{
    
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

   protected function loadData(): void
   {
       //Générer 3 admin
        $this->createMany(3,'user_admin',function(int $num){
            $user=new User();
            $password = $this->encoder->encodePassword($user,'admin'. $num);

            return $user
                ->setEmail('admin'.$num.'@createxte.fr')
                ->setRoles(['ROLE_ADMIN'])
                ->setPassword($password)
        ;
        });


       //générer 20 utilisateurs

       $this->createMany(20,'user_user',function(int $num){
        $user=new User();
        $password = $this->encoder->encodePassword($user,'user'. $num);

        return $user
            ->setEmail('user'.$num.'@createxte.fr')
            ->setPassword($password)
            ;
    });
   }


}
