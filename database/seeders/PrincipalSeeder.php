<?php

namespace Database\Seeders;

use App\Models\FooterPagina;
use App\Models\ImgSlider;
use App\Models\SliderPrincipal;
use Illuminate\Database\Seeder;

class PrincipalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SliderPrincipal::create([
            'texto' => 'Jornales',
            'user_id' => 1,
            'activo' => 1,
        ]);

        FooterPagina::create([
            'aviso_privacidad' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet neque ligula. Etiam commodo metus sit amet tortor finibus fermentum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Suspendisse facilisis purus quis risus mollis pretium. Integer condimentum consequat facilisis. Quisque sed magna sollicitudin, egestas enim vitae, dignissim nunc. Sed odio mauris, fringilla ac scelerisque sit amet, elementum ut lacus. Phasellus mattis aliquet pulvinar. Vivamus non tellus lorem. Curabitur ullamcorper pellentesque libero nec sodales. Integer a ultricies felis. Pellentesque lectus quam, tincidunt ut efficitur sit amet, fringilla a lorem.
Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aliquam fringilla odio sit amet congue ullamcorper. Duis leo enim, pellentesque nec diam eget, varius semper nisi. Sed in tempus est, quis laoreet odio. Morbi interdum dui erat, non pellentesque nisi convallis sed. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Fusce ut erat posuere, eleifend nisi quis, tristique dui. Curabitur auctor metus sed lectus consequat fermentum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nulla facilisi. Integer at mollis diam, non tristique justo. Aenean semper diam id viverra sollicitudin. Nam nibh neque, venenatis et est eget, malesuada vestibulum sapien.
Aliquam nec leo tincidunt, consequat mauris in, aliquet lectus. Maecenas accumsan in magna id commodo. Nunc ultrices lectus enim, vel convallis turpis convallis et. Nullam quis tortor a tortor mollis consequat blandit eu leo. Fusce at nulla hendrerit odio aliquam placerat eu a ex. Nunc ullamcorper mauris in dolor malesuada, sit amet vulputate diam ultrices. Suspendisse viverra augue sit amet leo commodo, ac blandit mauris imperdiet. Vivamus porttitor luctus rutrum.
Mauris pulvinar ornare nisi, a convallis dui gravida sed. Donec cursus nunc vel aliquam viverra. Ut id dui id sapien ultricies auctor ac in ex. Praesent ex metus, posuere ut sagittis in, fringilla eget ante. Proin sapien neque, rutrum nec nisl ut, tristique ultrices nibh. Proin efficitur, ante non consectetur malesuada, dui mi pulvinar justo, ac euismod turpis enim venenatis erat. Maecenas auctor enim purus, eget ultrices sapien molestie vitae. Fusce lobortis, dolor venenatis iaculis tincidunt, tortor nunc sollicitudin neque, non porttitor tellus lectus et quam. Suspendisse in sem enim.
Nulla feugiat nulla nec felis pretium, vitae gravida odio elementum. Etiam rutrum ipsum eu purus facilisis, non ornare enim ultricies. Etiam in dapibus erat. Suspendisse gravida suscipit dignissim. Quisque tincidunt lectus id efficitur fringilla. Nullam mattis accumsan arcu fringilla tincidunt. Sed convallis quam et mollis vestibulum. Curabitur rutrum justo ultricies metus tincidunt, in interdum enim scelerisque. Curabitur posuere lorem in ligula tristique feugiat. Ut sit amet congue nulla, at consequat nunc. Donec volutpat tellus mi, eu fringilla ipsum luctus in. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Phasellus vel tellus tortor. Nunc a nisl eget tellus faucibus laoreet. Cras sodales accumsan consequat. Duis eu lobortis lorem. ',
            'aviso_privacidad_resumen' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet neque ligula. Etiam commodo metus sit amet tortor finibus fermentum.',
            'ubicacion' => 'Leon, GTO.',
            'email' => 'prueba@gmail.com',
            'telefono' => '4381231962',
            'facebook_url' => 'https://www.facebook.com/Prueba',
            'facebook_activo' => 1,
            'twitter_url' => 'https://www.twitter.com/Prueba',
            'twitter_activo' => 0,
            'instagram_url' => 'https://www.instagram.com/Prueba',
            'instagram_activo' => 1,
        ]);

        ImgSlider::create(['img' => 'principal/img/carousel-1.jpg']);
    }
}
