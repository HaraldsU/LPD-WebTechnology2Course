<?php

namespace Database\Seeders;

use App\Models\Keyword;
use App\Models\BlogCategory;
use App\Models\Blog;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Keyword::create([
            'id' => 'Sports',
        ]);
        Keyword::create([
            'id' => 'President',
        ]);
        Keyword::create([
            'id' => 'Nature',
        ]);
        Keyword::create([
            'id' => 'Economics',
        ]);
        Keyword::create([
            'id' => 'Computer',
        ]);
        Keyword::create([
            'id' => 'Music',
        ]);
        Keyword::create([
            'id' => 'Discovery',
        ]);

        BlogCategory::create([
            'id' => 'Gaming',
            'link' => 'https://mediacloud.kiplinger.com/image/private/s--X-WVjvBW--/f_auto,t_content-image-full-desktop@1/v1615575009/Investing/best-video-game-stocks.jpg',
            'keyword1' => 'Computer'
        ]);
        BlogCategory::create([
            'id' => 'Politics',
            'link' => 'https://st2.depositphotos.com/1018728/6135/i/600/depositphotos_61350641-stock-photo-politician-at-press-conference.jpg',
            'keyword1' => 'President'
        ]);
        BlogCategory::create([
            'id' => 'Travel',
            'link' => 'https://t4.ftcdn.net/jpg/02/80/82/81/360_F_280828158_ZZ2W8atYMHiSkLoDzxgDHNhdmXJ31jCR.jpg',
            'keyword1' => 'Nature'
        ]);
        BlogCategory::create([
            'id' => 'Sports',
            'link' => 'https://thumbs.dreamstime.com/b/sports-tools-balls-shoes-ground-108686133.jpg',
            'keyword1' => 'Sports'
        ]);
        BlogCategory::create([
            'id' => 'Science',
            'link' => 'https://www.meme-arsenal.com/memes/bf8d8e46853e253694c29662e16a2355.jpg',
            'keyword1' => 'Nature',
            'keyword2' => 'Discovery'
        ]);
        BlogCategory::create([
            'id' => 'Movies',
            'link' => 'https://images.moneycontrol.com/static-mcnews/2020/08/STOCK-MARKET-MOVIES-770x433.jpg',
        ]);

        Blog::create([
            'name' => 'Why is Minecraft so popular?',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas porta elit non ligula accumsan,
            id mattis justo faucibus. Donec vel accumsan lectus. In tempus lacus vitae fringilla finibus. Fusce non ex libero.
            Nullam turpis ipsum, tincidunt id leo at, rhoncus consequat mauris. Donec dapibus, risus vitae auctor commodo, ligula
            nulla dictum lacus, sit amet lobortis magna risus id erat. Morbi lectus enim, volutpat eu pulvinar in, rhoncus eget
            orci. Mauris maximus leo eu ante gravida consectetur. Aliquam blandit posuere nisi, id lobortis metus volutpat nec.
            Aliquam ornare, mauris id volutpat pretium, enim purus luctus nisi, ut fringilla tellus tellus non magna. Sed convallis
            neque nec velit suscipit, a dapibus ante iaculis. Sed molestie tempus suscipit. Sed varius dui eleifend nibh mattis
            elementum. Vestibulum imperdiet dapibus erat in venenatis. Interdum et malesuada fames ac ante ipsum primis in faucibus.
            Cras at urna fermentum, iaculis sapien eget, gravida magna. Maecenas fringilla diam vitae laoreet finibus.',
            'link' => 'https://store-images.s-microsoft.com/image/apps.608.13510798887677013.5c7792f0-b887-4250-8c4e-4617af9c4509.bcd1385a-ad15-450c-9ddd-3ee80c37121a?mode=scale&q=90&h=1080&w=1920',
            'keyword1' => 'Computer',
            'category_id' => 'Gaming'
        ]);
        Blog::create([
            'name' => 'All presidents of the USA',
            'content' => 'Duis tempor leo eu vestibulum ornare. Duis nec orci auctor, sagittis nibh eget, suscipit nulla. Mauris ex nunc,
            molestie facilisis porta sit amet, vehicula a erat. Cras ac mauris egestas massa posuere rutrum ut nec mauris. Nullam luctus
            justo elementum dolor dignissim accumsan. Sed consequat, sem eu tincidunt feugiat, purus turpis pretium ipsum, id dignissim
            ligula lorem a nulla. Curabitur sed volutpat arcu. Proin vitae neque orci. Nam consectetur blandit felis at iaculis.
            Suspendisse potenti. Suspendisse porta ipsum lacus, at tincidunt elit ornare nec. Aliquam erat volutpat. Nullam ac mi turpis.
            Donec neque velit, tempus vel lacus et, tincidunt pretium nibh. Curabitur libero magna, posuere quis luctus a, lacinia id
            libero. Duis ullamcorper tempor sapien a ornare.
            Duis interdum eros libero, ac laoreet magna vehicula id. Quisque tincidunt, ipsum et lobortis sollicitudin, orci turpis
            condimentum turpis, quis ultricies mauris mauris vitae neque. Pellentesque lobortis, eros quis sollicitudin viverra, arcu
            augue feugiat neque, sit amet laoreet enim diam sit amet elit. Curabitur convallis lectus ut rutrum sollicitudin. Ut maximus
            lorem vel purus luctus condimentum. Donec facilisis nulla vitae lectus scelerisque tristique. Nullam sagittis id purus sit
            amet vestibulum. Donec cursus scelerisque tincidunt. Vivamus ut egestas mauris.',
            'link' => 'https://media-cldnry.s-nbcnews.com/image/upload/t_fit-760w,f_auto,q_auto:best/newscms/2022_24/3557695/220616-biden-marine-one-south-lawn-an.jpg',
            'keyword1' => 'President'
        ]);
        Blog::create([
            'name' => 'What is the healthiest diet?',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quis accumsan metus. Cras risus lorem, rutrum ut enim at, auctor suscipit ipsum. Duis a neque eget lacus tincidunt porttitor nec ut nulla. In nulla nibh, vulputate eget pellentesque a, feugiat non ligula. Quisque ultricies viverra diam, quis consectetur lectus consectetur at. Nunc eget egestas magna. Nulla porttitor ex augue, id bibendum metus aliquam vel. Sed pulvinar arcu a ultricies blandit. Integer tincidunt et nibh id sagittis. Integer congue eget lorem nec scelerisque. Quisque elementum turpis sed lacus mattis, in posuere massa faucibus. Nunc egestas rutrum sem, at lacinia urna malesuada sit amet. Nam pretium rutrum justo, ut bibendum diam pharetra at. Vivamus eget justo justo.
            Donec sit amet dolor eget nunc posuere varius. Vestibulum porta eros et purus suscipit, in auctor elit pulvinar. Sed molestie porta nibh quis sagittis. Maecenas ut nisi in velit ullamcorper tincidunt vitae vel purus. Curabitur laoreet tellus et euismod vehicula. Sed ultricies cursus est, et pulvinar sem sollicitudin eget. Ut ornare lorem id mattis accumsan. Vivamus dignissim, neque id imperdiet elementum, massa justo fringilla magna, vitae rutrum ipsum sem non lorem. Maecenas eget euismod felis. Morbi non auctor ante. Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque eu hendrerit libero.
            Duis commodo interdum tortor, consectetur sagittis augue efficitur sed. Ut vehicula purus at erat tristique pellentesque. Nunc facilisis justo non placerat sodales. Donec laoreet in enim eget bibendum. Aenean hendrerit eleifend tristique. In at sollicitudin lectus. Aliquam justo elit, venenatis luctus sem et, convallis elementum dui. Sed porta dictum tortor. Donec aliquet facilisis quam vitae malesuada. Etiam a libero in mi volutpat pharetra. Mauris viverra tellus sit amet lectus commodo, vitae condimentum sapien tristique.
            Nunc pharetra semper magna, non dapibus odio viverra id. Phasellus vehicula eget nulla sit amet gravida. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Integer in tellus eu urna finibus faucibus sit amet vel enim. Fusce maximus eros quis erat luctus molestie. Phasellus consequat risus sed magna euismod, vel tincidunt metus posuere. Sed condimentum nulla at nulla lacinia finibus. Duis enim velit, placerat a lacinia a, efficitur sed odio. Integer quis quam consectetur, maximus eros sagittis, interdum sapien. Proin tempus arcu quis lacinia venenatis. Nunc gravida hendrerit turpis sed efficitur. Sed sit amet mollis felis. Vivamus vel orci ullamcorper, elementum ligula vitae, blandit urna. In erat turpis, vestibulum placerat laoreet consectetur, viverra ac libero. Maecenas faucibus condimentum justo, at tincidunt nibh elementum id. Nam a eros sit amet ligula interdum tristique.
            Donec blandit est at posuere tincidunt. Suspendisse dignissim elit quis dolor consectetur rutrum. Nulla enim sem, dapibus ut laoreet eget, tincidunt vel elit. Vestibulum turpis dui, tincidunt id eros ac, bibendum efficitur orci. Quisque placerat ultricies lorem sed maximus. Cras nec mi lobortis, sodales libero eu, ornare ante. Morbi egestas justo blandit ligula bibendum, id ultricies eros ornare. Mauris tortor arcu, pretium et ligula quis, ultrices dapibus lacus. Vestibulum id porttitor turpis, efficitur condimentum lectus. Morbi pharetra nisi a arcu gravida dignissim.
            Maecenas id sollicitudin arcu, nec volutpat arcu. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis venenatis nunc at quam mattis, eget lacinia nibh vestibulum. Cras turpis dui, vestibulum non tempus vel, sodales sed magna. Cras tincidunt est lorem, in tempor nunc vehicula a. Pellentesque maximus porta dolor nec euismod. Duis cursus odio in tellus euismod, dictum luctus urna accumsan. In sodales neque vitae magna posuere, nec accumsan nunc efficitur. Maecenas sit amet leo ullamcorper, malesuada metus id, ornare massa.
            Mauris fermentum neque in lorem fermentum auctor. Nam malesuada justo vulputate rutrum sagittis. Fusce eros risus, aliquet eget pretium quis, tincidunt finibus dolor. Vestibulum ac elit eu nisl luctus laoreet nec ac est. Pellentesque nec tortor ante. Aenean iaculis scelerisque rhoncus. Donec sapien elit, suscipit ac euismod sed, laoreet eu nibh.
            Etiam in quam ut augue tincidunt tristique. Nullam lacinia, quam eget molestie blandit, ipsum est scelerisque orci, eget lobortis nibh velit sit amet elit. Praesent fringilla augue sed neque tristique ultrices. Nulla condimentum felis massa, id euismod ante lobortis quis. Sed ex mi, accumsan at hendrerit sit amet, consequat non orci. Etiam non lacus orci. Proin ornare vel ex et hendrerit. Suspendisse venenatis, nulla et sagittis rhoncus, felis nibh ullamcorper dolor, eu tristique nunc mi pulvinar nulla. Ut nec rhoncus mauris. Mauris id scelerisque ipsum, at luctus augue. Sed congue sit amet justo id faucibus. Duis ut metus risus. In feugiat et ipsum sagittis vestibulum. Sed imperdiet at velit vel accumsan.
            Proin a nisi gravida, dictum erat at, elementum elit. Mauris iaculis ut arcu eget faucibus. Integer accumsan sapien ultricies convallis venenatis. Cras quis mattis lorem. Duis aliquam sapien congue, rutrum augue sed, maximus urna. Ut et elit vitae tellus aliquam blandit eu a risus. Sed tincidunt vehicula nibh, ut dignissim augue.
            Sed finibus tempus mi, mollis tempor erat. Maecenas gravida gravida cursus. Donec sed convallis eros. Nulla non diam mauris. Mauris elementum eleifend elementum. Pellentesque molestie sagittis neque quis placerat. Cras quis orci tincidunt, placerat ipsum in, congue lorem. Nam id pretium enim, eu placerat purus. Vivamus ullamcorper odio urna, at varius nunc condimentum eget. In nisi nulla, posuere nec porttitor eget, vestibulum laoreet ipsum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan est non augue vestibulum pulvinar. Class aptent taciti sociosqu a',
            'link' => 'https://media.istockphoto.com/photos/balanced-diet-food-background-picture-id1151799593?k=20&m=1151799593&s=612x612&w=0&h=jRs5hyc8u1QZ1hqL5IrPQTwyXqG_i2KGyYDlN7IbCzY=',
            'category_id' => 'Science'
        ]);
        Blog::create([
            'name' => 'How healthy is the gym?',
            'content' => 'Integer facilisis gravida enim, eu tempus mauris fermentum nec. Nunc sagittis blandit purus vitae accumsan. Duis malesuada neque magna, vel malesuada metus aliquet nec. Vestibulum ut sem elit. Suspendisse aliquet iaculis felis, imperdiet venenatis ipsum consectetur sit amet. Suspendisse semper, odio a facilisis dapibus, quam diam accumsan felis, a mattis lectus massa ut leo. Maecenas sed urna eget mauris pulvinar fermentum eu non augue. Curabitur massa orci, commodo a sem sit amet, dictum dapibus mauris. Praesent lobortis iaculis congue. Ut non risus elit. Vestibulum vehicula tellus ut aliquam rhoncus. Donec finibus porttitor velit, vel pulvinar nulla tempor et. Donec aliquam vestibulum mi, ac semper neque mollis luctus. Cras a justo eget urna vehicula imperdiet. Donec luctus id odio efficitur laoreet.
            Ut ultricies vitae eros eget viverra. Suspendisse sit amet odio nisi. Integer mattis massa odio, id imperdiet erat placerat et. Maecenas ac lectus et enim tincidunt rutrum. Proin aliquam elit a lacus porttitor, eget molestie augue cursus. Ut in nulla accumsan, accumsan ante id, commodo diam. In non suscipit justo, in porta neque. Morbi eget laoreet odio. Proin pretium aliquet mattis. Aliquam ut accumsan orci. Quisque sed efficitur nibh. Fusce ultrices felis at eleifend auctor.
            Aenean pellentesque, libero non gravida congue, ligula lorem ultrices magna, a dignissim enim odio nec tellus. Nunc gravida consectetur magna, vitae tincidunt eros ornare ut. Nullam vel libero fringilla, imperdiet erat convallis, porta ipsum. Nam bibendum, ipsum quis feugiat maximus, massa augue egestas nisl, eget aliquam urna diam eget ligula. Quisque ornare rhoncus sapien sit amet feugiat. Sed at vestibulum ipsum. Vivamus id sem ac mauris lacinia commodo. Nulla porta est sapien, vitae aliquet ligula sagittis sed. Nunc volutpat commodo justo, ultrices malesuada metus semper in. Duis commodo orci sed ligula auctor, ut varius lacus mollis. Maecenas ac tristique nunc, eget aliquet risus. Vivamus viverra tempor quam non imperdiet. Sed ut accumsan leo, vel suscipit nibh. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            Nunc faucibus quam ex, gravida aliquam odio sodales sed. Aliquam ac hendrerit velit, eu blandit lorem. Aliquam lacinia nulla a pretium ultricies. Aenean quis neque eget odio fermentum lacinia. Curabitur euismod porta elit, eu dapibus nisl rutrum ut. Aliquam erat volutpat. Nam viverra placerat sem, non ullamcorper lectus tincidunt eu. Etiam tempor eleifend ultricies. Vestibulum ante elit, lobortis et diam vel, molestie bibendum velit. Vivamus dolor turpis, feugiat sed tincidunt at, maximus sed nisl. In non dui feugiat, interdum tortor sed, lacinia ex.',
            'link' => 'https://t4.ftcdn.net/jpg/03/17/72/47/360_F_317724775_qHtWjnT8YbRdFNIuq5PWsSYypRhOmalS.jpg',
            'keyword1' => 'Sports',
            'category_id' => 'Sports'
        ]);
        Blog::create([
            'name' => "5 things you didn't know about cats",
            'content' => 'Curabitur a est rutrum, varius dolor tempus, ullamcorper felis. Donec sollicitudin quam ac est mollis, aliquet varius eros bibendum. Pellentesque sit amet mollis neque. Suspendisse semper, quam et blandit tincidunt, nisl odio ullamcorper nibh, id suscipit ipsum leo et eros. Morbi eget sollicitudin velit. Nullam mattis felis augue, at rhoncus magna aliquet ultrices. Aenean vehicula mollis convallis. Ut et odio velit. Praesent posuere cursus pellentesque. Morbi dignissim metus at neque ullamcorper laoreet. Duis lobortis, velit vel faucibus ornare, dui nisi laoreet erat, ut viverra magna lorem vel nunc. Cras fringilla accumsan nisl, nec gravida elit rhoncus id. Suspendisse placerat, sem vel auctor venenatis, nibh dolor mattis lectus, at tristique velit quam sagittis arcu.
            Integer lobortis lacus at nisl consectetur tincidunt. Suspendisse potenti. Sed volutpat lacinia mi nec feugiat. Nulla ac venenatis tellus. Duis egestas blandit lacinia. In placerat rutrum pretium. Aliquam eget dui iaculis, ultricies arcu non, iaculis lectus. Praesent viverra augue ipsum, eu dignissim ligula congue eget. Aenean lectus nulla, suscipit id massa non, malesuada sagittis tellus. Phasellus molestie dui ut ipsum auctor pulvinar. Suspendisse cursus sapien nunc, ut tincidunt massa condimentum eget. In eu elementum nisl, vestibulum elementum eros. Vivamus ut tellus eget elit dignissim semper a vel mauris. Ut mi nulla, ornare sit amet purus sed, tempor vehicula odio. Proin nisi ante, ultricies id fermentum commodo, varius at elit.
            Curabitur pulvinar lectus at ligula bibendum pulvinar. Praesent at nulla non augue consectetur auctor in non sem. Mauris ut arcu sem. Sed quis sapien rhoncus, finibus quam eget, sollicitudin dolor. Phasellus sollicitudin, risus ultricies tempor tempor, eros orci scelerisque orci, sit amet elementum dui massa quis quam. Cras accumsan ex at scelerisque fermentum. Cras nulla eros, aliquet id libero placerat, dictum viverra enim. Ut dapibus, mi ut dapibus facilisis, mauris augue tristique sapien, sed ornare risus velit et est. Nullam nec nibh tellus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed sed luctus sem. Curabitur nec congue enim. Aenean et augue velit. Ut mollis ex at pharetra bibendum.
            Cras efficitur enim nec tincidunt cursus. Nunc rutrum nisi arcu, cursus tincidunt massa pharetra et. In eu scelerisque enim, non vulputate lacus. Aliquam erat volutpat. Aliquam sodales, sem vel volutpat pulvinar, sem mauris aliquam erat, ac hendrerit dolor risus et augue. Donec eget tristique justo. Ut sodales vestibulum leo, nec aliquam urna auctor tempus. Nunc ac hendrerit lectus. Duis tincidunt molestie urna vitae commodo. Mauris blandit erat lacus, et consequat nunc congue porttitor. Integer ac accumsan odio.
            Nullam euismod viverra magna, et maximus urna auctor ac. Integer ornare a ipsum et pretium. Sed pellentesque turpis quis porttitor posuere. Sed tortor risus, volutpat eget orci at, placerat ultrices urna. Praesent sagittis mi ac aliquam efficitur. Proin non erat tempor, interdum lorem et, rhoncus nisi. Nam vel purus et nunc pellentesque porta at non tellus. Proin eu dui viverra, pellentesque neque at, tristique lorem. Nunc vestibulum placerat vulputate. Sed facilisis in orci sed feugiat. In hendrerit, purus nec aliquet convallis, odio diam fermentum justo, ut lacinia neque neque vitae nibh. Maecenas auctor magna et erat imperdiet, eget cursus tortor suscipit. Etiam ut est eu elit scelerisque condimentum.',
            'link' => 'https://thumbs.dreamstime.com/b/group-cats-front-white-background-60530177.jpg',
            'keyword1' => 'Nature'
        ]);
        Blog::create([
            'name' => 'Why are Crypto prices taking a dive?',
            'content' => 'Sed eu convallis dui. Sed porta aliquam fermentum. Nam sit amet ullamcorper lorem. Suspendisse dictum commodo nunc vel elementum. Phasellus sit amet dolor non risus volutpat consequat in ac odio. Proin quam erat, pellentesque eleifend metus a, condimentum egestas massa. Sed in rutrum dui. Vestibulum sagittis hendrerit ultrices.',
            'link' => 'https://image.cnbcfm.com/api/v1/image/107069560-1654078537245-gettyimages-1235570446-porzycki-cryptocu210928_npIa0.jpeg?v=1654240198',
            'keyword1' => 'Economics'
        ]);
        Blog::create([
            'name' => 'Biggest musical artists 2022',
            'content' => 'Nunc maximus nisi ac erat lacinia, vitae convallis lorem bibendum. Quisque in libero eget velit sagittis luctus vel sit amet erat. Fusce porttitor nulla sit amet quam aliquet pellentesque. Integer accumsan dolor eget felis imperdiet pellentesque. Quisque ex nisi, varius ac dui a, tincidunt condimentum nunc. Fusce aliquet bibendum justo sed porttitor. Nam urna nulla, ornare ac eros posuere, viverra consequat lacus.',
            'link' => 'https://www.cleveland.com/resizer/iX-17fSQ-aO7KH-dVjT9n64ixIo=/1280x0/smart/advancelocal-adapter-image-uploads.s3.amazonaws.com/expo.advance.net/img/960b45d730/width2048/57e_collage1.jpeg',
            'keyword1' => 'Music'
        ]);
        Blog::create([
            'name' => 'How dangerous is COVID-19?',
            'content' => 'Curabitur ac sapien ac tellus ultrices blandit id id dolor. Suspendisse tincidunt ante quis nisi venenatis, nec auctor justo dictum. Vivamus id lorem placerat, interdum nunc sit amet, accumsan leo. Vestibulum consequat, sem sed consectetur imperdiet, sapien nisl semper odio, vitae consectetur enim mauris quis turpis. Aliquam erat volutpat. Mauris justo lacus, hendrerit pulvinar ex ut, efficitur faucibus lorem. Nunc ullamcorper diam id massa suscipit, vel condimentum est vestibulum. Fusce imperdiet, libero eu semper malesuada, tortor libero eleifend ante, nec varius eros nibh vitae ligula. Cras vehicula pretium sem in porta.',
            'link' => 'https://content.presspage.com/uploads/2110/1920_coronavirus-covid19-cedars-sinai.jpg?10000',
            'keyword1' => 'Nature',
            'category_id' => 'Science'
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123123'),
            'isAdmin' => '1'
        ]);
        User::create([
            'name' => 'HaraldsU',
            'email' => '11rembo11pvp@gmail.com',
            'password' => bcrypt('haraldsu123'),
            'isAdmin' => '0'
        ]);
        User::create([
            'name' => 'longlonglonglonglonglonglonglonglonglonglonglonglonglonglong',
            'email' => 'long@long.com',
            'password' => bcrypt('longlong123'),
            'isAdmin' => '0'
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
