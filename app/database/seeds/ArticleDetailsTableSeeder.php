<?php

class ArticleDetailsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('article_details')->truncate();

		$articles = array(
			['article_id' => '52c19a22ce106',
			'user_id'     => '52c19a22743c9',
			'title'       => 'Коом жетекчисинин кайрылуусу',
			'content'     => '<p>Түзүлгөн күндөн бери &quot;Кыргызстан достук жана маданият коому&quot;көптөгөн&nbsp; алгылыктуу иш аракеттерди жүргүзүп келе жатат.</p><p>Күндөн күнгө коомубуздун мүчөлөрү көбөйүп уюштурган программаларыбыздын деңгеели жогорулап, мындан ары да коомубуз көптөгөн максаттарга жетишүүгө умтула бермекчи. Аткарылып жаткан иш-арекеттердин жана мындан аркы максаттардын негизинде, боордош Түркия мамлекетинде жашап, иштеп жана билим алып жаткан Кыргызстандык атуулдарыбыздын ынтымагын бекемдөө, биримдигин чыңоо менен бирге мекенибиз Кыргызстан жана бир тууган Түркия мамлекети ортосундагы ар түрдүү мамилелердин өркүндөп өсүшү, элибиздин, жерибиздин келечеги кең болушу үчүн салым кошуу сыяктуу жоболор жатат.</p>',
			'desc'        => '',
			'lang'        => 'kg',
			'created_at'  => date('Y-m-d H:i:s'),
			'updated_at'  => date('Y-m-d H:i:s')],
			['article_id' => '52c19a22ce128',
			'user_id'     => '52c19a22743c9',
			'title'       => 'Başkanın Mesajı',
			'content'     => '<p>Kurulduğu g&uuml;nden itibaren Kırgızistan Dostluk ve K&uuml;lt&uuml;r Derneği bir&ccedil;ok &ouml;nemli faaliyete imza atmıştır. G&uuml;n ge&ccedil;tik&ccedil;e derneğimizin &uuml;ye sayısı &ccedil;oğalmakla birlikte d&uuml;zenlediği her &ccedil;eşit programların niteliği de artmaktadır.&nbsp;Bundan sonra da bir&ccedil;ok hedefe ulaşmak i&ccedil;in &ccedil;alışmalarına devam edecektir. Bug&uuml;ne kadar yapılan faaliyetlerimizde olduğu gibi bundan sonraki &ccedil;alışmalarımızın esasında kardeş &uuml;lke T&uuml;rkiye&#39;de ikamet eden Kırgızistan vatandaşlarının birlik ve beraberliğini pekiştirmekle birlikte, Kırgızistan ve T&uuml;rkiye arasındaki her alandaki ilişkilerin daha da gelişmesine ve &uuml;lkemiz Kırgızistan&#39;ı aydınlık bir geleceğe ulaşmasına katkı sağlamak gibi ilkeler yatmaktadır.</p>',
			'desc'        => '',
			'lang'        => 'tr',
			'created_at'  => date('Y-m-d H:i:s'),
			'updated_at'  => date('Y-m-d H:i:s')],
			['article_id' => '52c19a22ce11b',
			'user_id'     => '52c19a22743c9',
			'title'       => 'Президентибиз Алмазбек Атамбаев Кыргызстан Достук жана Маданият Коомунун ачылыш аземинде',
			'content'     => '<p>Баарыбызга белгилүү болгондой эле &nbsp;коомубуздун жаңы кеңсесин 15-январ саат 11:00до ачылыш аземи болуп өттү. Коомубуздун ачылыш аземине Түркияга расмий иш сапары менен келген Кыргыз Республикасынын&nbsp;президенти Алмазбек Шаршенович Атамбаев катышты. Ошондой эле жаңы кенсебиздин ачылышына Кыргыз Республикасынын Маданият жана Туризм министири Ибрагим Жунусов, Тышкы иштер министири Руслан Казакбаев, Жогорку Кеңештин комитет төрагалары, Кыргызстандын Түркиядагы Анкара Элчилиги, Кыргызстандын Стамбулдагы &nbsp;Генконсулдугу, өлкөбүздүн алдыңкы кабарчылары жана журналисттери катышты. Андан тышкары жергиликтүү протоколдон Стамбул губернаторлугундан, Стамбул мериялыгындан, Бахчелиевлер, Зейтинбурну, Багжылар, Эйүп муниципалитеттеринин башчылары жана Түрк Дүйнөсү Муниципалитеттер Бирдиги келишти. Кыргызстан Достук жана Маданият Коомунун ачылышын &nbsp;кылган президентибиз Алмазбек Атамбаев ачылышка келген коноктор менен бирге эстеликке &nbsp;сүрөткө түшкөн соң, коомубуз үчүн өз батасын берди.Келген конокторго Кыргыз улуттук тамактары тартууланып, ачылыш аземин Кыргызстан Достук жана Маданият Коомунун башчысы Айбек Сарыгуловдун бүгүнку күнго чейин кылынган иш - аракеттер жана ошондой эле мындан кийинки боло турган маарекелер жана иш - чаралар жөнүндө маалымат берүүсү менен бирге коом демөөрчүлөрүнө да ыраазычылыгын билдирип кетти.</p>',
			'desc'        => '',
			'lang'        => 'kg',
			'created_at'  => date('Y-m-d H:i:s'),
			'updated_at'  => date('Y-m-d H:i:s')],
			['article_id' => '52c19a22ce11b',
			'user_id'     => '52c19a22743c9',
			'title'       => 'Kırgızistan Cumhurbaşkanı Almazbek Atambayev, Kırgızistan Dostluk ve Kültür Derneği`nin İstanbul Şirinevler`deki Merkezinin Açılış Törenine Katıldı',
			'content'     => '<p>Kırgızistan Dostluk ve K&uuml;lt&uuml;r Derneği yeni merkezinin a&ccedil;ılışına 15 Ocak 2012 g&uuml;n&uuml; saat 12.30&rsquo;da resm&icirc; ziyaret i&ccedil;in T&uuml;rkiye&rsquo;de bulunan Kırgızistan Cumhurbaşkanı sayın Almazbek Atambayev, Kırgızistan Dış İşleri Bakanı&nbsp;Ruslan Kazakbayev ve ayrıca Kırgızistan Parlamentosu milletvekilleri İstanbul Vali Yardımcısı Harun Kaya, TDBB Başkan Yardımcısı, Hendek Belediye Başkanı Ali İnci, Kırgızistan Antalya Fahri Konsolosu, Bah&ccedil;elievler Kaymakamı, TDBB Genel Sekreteri Mustafa Başkurt, Sebat Eğitim Kurumları Başkanı Orhan İnaldı, Trt Avaz Genel Koordinat&ouml;r&uuml; Adnan S&uuml;er, Ey&uuml;p Belediye Başkanı İsmail Kavuncu, Kırgızistan&rsquo;da ticaretle uğraşan T&uuml;rk iş adamları ve T&uuml;rkiye&rsquo;de ticaret yapan Kırgız iş adamlarının katılımıyla ger&ccedil;ekleşti.Resmi heyete Kırgızistan Dostluk ve K&uuml;lt&uuml;r Derneği Başkanı Aybek Sarıgul eşlik etti. A&ccedil;ılışı Trt Avaz, Stv ve bir&ccedil;ok kanal ve haber ajansları ve gazeteciler takip etti. A&ccedil;ılış kurdelasını kesen cumhurbaşkanı Almazbek Atambayev k&uuml;lt&uuml;r merkezini gezerken zaman zaman duygulu anlar yaşadı. Dernek hakkında yetkililerden bilgi aldı. Ayrıca konuklarla hatıra fotoğrafı &ccedil;ektirdi. A&ccedil;ılış sonrası kokteyl verildi. Kokteylde Kırgız mutfağının yemekleri takdim edildi. Ayrıca Avrasya Yıldızı G&uuml;lcigit Kalıkov Kırgızca şarkılar s&ouml;yledi. İstanbul&rsquo;da &ouml;ğrenim g&ouml;ren &ouml;ğrenciler komuzla melodiler &ccedil;aldı.</p>',
			'desc'        => '',
			'lang'        => 'tr',
			'created_at'  => date('Y-m-d H:i:s'),
			'updated_at'  => date('Y-m-d H:i:s')],
			['article_id' => '52c19a22ce128',
			'user_id'     => '52c19a22743c9',
			'title'       => 'Кыргызстандык ишкердер коомубузда конокто болду',
			'content'     => '<p>Кыргыстандын мамлекеттик иштеринде зор эмгеги өткөн Жемил Жамалов, Рыскул Мухамеджанов, өлкбүздө мыкты иш алып барган түрк ишкери К. Мустафа Жонгер жана Түрк Дүйнөсү Мэриялар Бирдигинин башкы катчысы&nbsp;Мустафа Башкурт 2012 11-Февраль күнү Стамбулдагы Кыргызстан Достук жана Маданият Коомунда конокто болду. Коомубуздун төрагасы Айбек Сарыгулов жана Башкы катчы Мирланбек Нурматовдон Түркияда жашаган кыргыздар жөнүндө кеңири маалымат алышты. Айрыкча Түркияда ийгиликтүү иш жүргүзүп Түркиянын экономикасына чоң салымын кошуп жаткан кыргыз ишкерлери туурасында Айбек Мырза маалымат берди.</p>',
			'desc'        => '',
			'lang'        => 'kg',
			'created_at'  => date('Y-m-d H:i:s'),
			'updated_at'  => date('Y-m-d H:i:s')]
		);

		// Uncomment the below to run the seeder
		// DB::table('article_details')->insert($articles);
	}

}
