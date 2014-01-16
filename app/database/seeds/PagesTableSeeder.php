<?php

class PagesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('pages')->truncate();

		$pages = array(
			['id'        => uniqid(),
			'name'       => 'help',
			'content'    => '<h2>Кайрымдуулук</h2>
							<div>
							<p>Кыргызстандын Ош областына караштуу, Карасуу районунун, Жоош айылында жайгашкан&nbsp;Карасуу дүлөй(кулагы укпаган) балдар мектеп-интернаты жана Ж. Бокомбаев балдар үйү&nbsp;үчүн КР МИДтин тактамы боюнча&nbsp;КДМК кайрымдуулук компаниясы уюштурат. МИДтен алынган расмий катка караганда&nbsp;интернатта 0-9 класс арасы 175 өспүрүм окуйт. Интернаттын имаратын кайрадан оңдоо үчүн&nbsp;акчалай түрдө жана балдар-кыздар үчүн жаңы жана колдонулган(колдонулган кийимдер таза&nbsp;жуулуп үтүктөлүшү зарыл) жазгы-жайкы кийим кече жана мектеп буюмдары жөнөтүлөт. Эгер&nbsp;сиздин да жардам бергиңиз келсе анда үстүдөгү тизмеде айтылган буюмдарды жана акчалай&nbsp;түрдө жардамынызды Стамбул, Шириневлердеги КДМКнын боорборуна май айынын башына&nbsp;чейин тапшырсаныздар болот.</p>
							<p>Байланыш тел: 0(212) 653 00 87</p>
							<p>Факс: 0(212) 653 00 86</p>
							</div>',
			'lang'       => 'kg',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')],
			['id'        => uniqid(),
			'name'       => 'projects',
			'content'    => '<h2>Долбоорлор</h2>
							<div>
							<p>Бул бөлүмдө &laquo;Кыргызстан Достук жана Маданият Коому&raquo; коомдук уюмубуздун социалдык жардамдашуу, кыргыз маданиятын таанытуу, өлкөлөр арасындагы достук мамилелерди чыңдоо, иш дуйнөсүн өркүндөтүү, чет өлкөлөрдө&nbsp;жүргөн кыргыз жарандарынын өз ара карым катнашын күчтөндүрүү, иш дүйнөсүн өркүндөтүү жана талим тарбия жаатында иш алып баруу үчүн алдыга койгон максаттарыбызды ишке ашырууга көмөк көрсөтүлө&nbsp;турган долбоорлорубуз таанытылмакчы.</p>
							<p>Уюмубуздун алгачкы долбоорлору:&nbsp;&nbsp;</p>
							<p><strong>Илим-Билим</strong></p>
							<p>Бул долбоорубуз менен алгач Туркия жергесинде илимдин аркасында жүргөн урматтуу билим адамы, агай эжелерибизди таанытмакчыбыз. Илимдин аркасындагы мекендештерибизди таанытып, колдоо менен бирге алардын келечек үчүн кылган кызматтарын баалаганды үйрөнүүгө&nbsp;далалат кылмакчыбыз.</p>
							<p>Кийинки илим-билим жаатындагы долбоорубуз Туркиядагы жогорку окуу жайларын бүтүргөн мекендештерибиздин бүтүрүү тездерин, кандитаттык тездердин, диссертациялардын билги банкасына топтоп жыйнак кылуу. Бул долбоорубуздун негизинде Туркияда билим алган мекендештерибиздин ишмердүүлүгүн таанытып, келечекте билим ала турган мекендештерге керектүү база түзүп берүү ниетибиз жатат.</p>
							<p>Илим-билим жаатындагы кийинки долбоорубуз бул котормочулар. Илим-билим, адабият, театр жана кино, котормочулар болбосо дүйнөгө&nbsp;таанытыла албайт. Бул долбоорубуз менен келечекте өлкөбүздү дүйнөгө&nbsp;жана дүйнөнү&nbsp;өлкөбүзгө&nbsp;тааныта турган котормочуларды бир арага топтоп, иш аракеттерин колдоо&nbsp;үчүн иш чараларды алып бармакчыбыз.&nbsp;&nbsp;</p>
							<p><strong>Иш дуйносу</strong></p>
							<p>Иш дүйнөсүндөгү алгачкы долбоорубуз Туркия жергесинде эмгектенип жаткан мекендештерибиздин&nbsp;билги банкасын топтоо. Билги банкасына бириккен маалыматтарды коомчулукка тартуулап мекендештерибиздин иш чөйрөсүнүн өнүгүүсүнө&nbsp;шарт түзүү. Туркиядагы иш чөйрөсү менен кызматташууга кызыккан ишкерлер үчүн оңой жеткиликтүү маалыматттарды ушул долбоорубуз менен сунуштамакчыбыз.</p>
							<p>Келечектүү долбоор катары иш-дуйнөсү долбоорлорубузга кыргызстандыктардын эл аралык иш форуму&nbsp;<a href="http://www.bizforumkg.org/">&quot;Бизнес Форум Кыргызстан&quot;</a>&nbsp;долбоорун демилгеледик. 2012-жылы биринчиси уюштурула турган&nbsp;форумду&nbsp;Стамбул шаарында өткөрүү боюнча чечим кабыл алып, мындан кийин дагы жыл сайын өткөзүлө турган форум болуусу үчүн өзүнчө уюштуруу комитети белгиленди. Бул форумдун негизги максаты чет элде жүрүп өз ишин өркүндөткөн ишкерлерибизге таанышуу, кабарлашуу, кызматташуу менен ишин дагы да өркүндөтүүгө көмөк түзүп берүү.&nbsp;Мындан кийин башка уюмдар дагы демилебизди колдоп, жыл сайын өткөзүп улантып кетет деген тилегибиз бар.</p>
							<p><strong>Маданият</strong></p>
							<p>Кыргыз маданиятын танытуу максатында Кыргызстан Достук жана Маданият Коому, Туркиянын ТРТ Аваз телерадиокомпаниясы менен биргеликте ОО Мультимедиа ортосунда жаңы бир келишимге кол коюшту. Бул келишим негизинде Кыргызстанда ОО Мультимедиа Кыргызстандын түрдүү жактарын таныткан 30 минуталык 13 эпизоддон турган теле программа даярдайт. Даярдалган телепрограммалар ТРТ Аваз телерадиокомпаниясы аркылуу эфирге алып чыгарылат.</p>
							</div>',
			'lang'       => 'kg',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')],
			['id'        => uniqid(),
			'name'       => 'contacts',
			'content'    => '<h2>Байланыш</h2>
							<div>
							<p>Дарек:</p>
							<p>H&uuml;rriyet&nbsp; Mah.&nbsp; Eski&nbsp; Londra&nbsp; Asfaltı, &nbsp; &Ouml;naldı &nbsp;İş &nbsp;Merkezi</p>
							<p>No:6 &nbsp; Kat:4&nbsp; / &nbsp;Şirinevler &nbsp;/ &nbsp;İstanbul&nbsp; / &nbsp;T&uuml;rkiye</p>
							<p>Тел: &nbsp; &nbsp; +90 212 653 00 87</p>
							<p>Факс: &nbsp;+90 212 653 00 86</p>
							<p>GSM: &nbsp; + 90 533 466 06 88</p>
							<p>Email: &nbsp;&nbsp;info@kyrgyzstan.org.tr</p>
							</div>',
			'lang'       => 'kg',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')],
			['id'        => uniqid(),
			'name'       => 'contacts',
			'content'    => '<h2>Байланыш</h2>
							<div>
							<p>Дарек:</p>
							<p>H&uuml;rriyet&nbsp; Mah.&nbsp; Eski&nbsp; Londra&nbsp; Asfaltı, &nbsp; &Ouml;naldı &nbsp;İş &nbsp;Merkezi</p>
							<p>No:6 &nbsp; Kat:4&nbsp; / &nbsp;Şirinevler &nbsp;/ &nbsp;İstanbul&nbsp; / &nbsp;T&uuml;rkiye</p>
							<p>Тел: &nbsp; &nbsp; +90 212 653 00 87</p>
							<p>Факс: &nbsp;+90 212 653 00 86</p>
							<p>GSM: &nbsp; + 90 533 466 06 88</p>
							<p>Email: &nbsp;&nbsp;info@kyrgyzstan.org.tr</p>
							</div>',
			'lang'       => 'tr',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')],
			['id'        => uniqid(),
			'name'       => '404',
			'content'    => '<h3>Баракча табылбады</h3>',
			'lang'       => 'kg',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')],
			['id'        => uniqid(),
			'name'       => '404',
			'content'    => '<h3>Sayfa bulunamadı</h3>',
			'lang'       => 'tr',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')],
			['id'        => uniqid(),
			'name'       => 'associates',
			'content'    => '<h2>Ortaklar</h2>
							<p><a href="http://wp.jia.kg/" target="_blank"><img alt="" src="/img/sponsors/jia.png" style="height:76px; width:121px" /> </a> <a href="http://www.zpress.kg/" target="_blank"> <img alt="" src="/img/sponsors/zamandash_logo.jpg" style="height:89px; width:68px" /> </a> <a href="http://kyrgyzclub.org/" target="_blank"> <img alt="" src="/img/sponsors/kg_club.jpg" style="height:81px; width:129px" /> </a> <a href="http://egemendik.org/" target="_blank"> <img alt="" src="/img/sponsors/egemendik_logo.jpg" style="height:93px; width:93px" /> </a> <a href="http://www.kyrgyzamerican.org/" target="_blank"> <img alt="" src="/img/sponsors/kyrusass.jpg" style="height:91px; width:92px" /> </a> <a href="http://kyrgyz.org.ua/" target="_blank"> <img alt="" src="/img/sponsors/ukr_logo.png" style="height:95px; width:94px" /></a></p>',
			'lang'       => 'tr',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')],
			['id'        => uniqid(),
			'name'       => 'associates',
			'content'    => '<h2>Көмөктөштөр</h2>
							<p><a href="http://wp.jia.kg/" target="_blank"><img alt="" src="/img/sponsors/jia.png" style="height:76px; width:121px" /> </a> <a href="http://www.zpress.kg/" target="_blank"> <img alt="" src="/img/sponsors/zamandash_logo.jpg" style="height:89px; width:68px" /> </a> <a href="http://kyrgyzclub.org/" target="_blank"> <img alt="" src="/img/sponsors/kg_club.jpg" style="height:81px; width:129px" /> </a> <a href="http://egemendik.org/" target="_blank"> <img alt="" src="/img/sponsors/egemendik_logo.jpg" style="height:93px; width:93px" /> </a> <a href="http://www.kyrgyzamerican.org/" target="_blank"> <img alt="" src="/img/sponsors/kyrusass.jpg" style="height:91px; width:92px" /> </a> <a href="http://kyrgyz.org.ua/" target="_blank"> <img alt="" src="/img/sponsors/ukr_logo.png" style="height:95px; width:94px" /></a></p>',
			'lang'       => 'kg',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')],
			['id'        => uniqid(),
			'name'       => 'business',
			'content'    => '<h2>Иш дүйнөсү</h2>
							<div>
							<p><strong>Урматтуу мекендештер!</strong></p>
							<div>Кыргызстан достук жана маданият коому Түркия мамлекетиндеги жеке ишин ачкан жана чоң фирмаларда иштеген жаш ишкерлерди өз ара тыгыз байланыштыруу жана тааныштыруу максатында атайын бир проект түзүп жатат. Проект боюнча Түркияда Кыргызстандыктардын иштеген фирмаларынын аты-жөнү, секторлору, экспорт-импорт кылып иштешкен чет өлкөлөрү, фирмалары боюнча кеңири маалыматтар атайын коомдун сайтында жарыяланмакчы. Фирмалар арасы байланыш үчүн атайын&nbsp;<a href="mailto:isdunyasi@yahoogroups.com">isdunyasi@yahoogroups.com</a>&nbsp;курулуп жатат. Эгерде сиз иштеген фирма дагын ал жерге жазылсың десеңиз коомго кайрылып ишкерлер мүчөлүк формун толтуруңуз. Суроолор боюнча кайрылып туруу үчүн&nbsp;<a href="mailto:isdunyasi@kyrgyzstan.org.tr">isdunyasi@kyrgyzstan.org.tr</a>&nbsp;электрондук почта адресин ачып жатабыз.</div>
							<div>Биз бул ишкерлер тобун уюштуруудагы максатыбыз өзгөчө Россия, Украина, Казахстан, Кыргызстан, Америка, Кытай жана Туркия сыяктуу өлкөлөрдө ар түрдүү соода тармактарында иш алып барып жаткан кыргыз ишкер мекендештерибизди бири бири менен тыгыз байланыштыруу.</div>
							<div>Ишкерлерибизге Тускон, Китиад, Катиад, Рутид жана Жиа сыяктуу чоң уюмдардын бизнес форумдарына катышуу жана алардан маалымат алып туруу мүмкүнчүлүктөрүн түзүп берүү.</div>
							<div>Биздин эң негизги максатыбыз азырынча Түркиядагы келечекте бүткүл дүнйөдөгү Кыргыздардын иштеп жаткан фирмаларынын базарын кеңейтүү.</div>
							</div>',
			'lang'       => 'kg',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')],
			['id'        => uniqid(),
			'name'       => 'istanbul',
			'content'    => '<h2>Стамбул</h2>
							<div class="page-inset" style="font-size: 12px; color: rgb(78, 78, 78); font-family: Arial; line-height: 18px;">
							<p><strong>Башкаруу Кеңеши :</strong></p>
							<p>Айбек Сарыгулов</p>
							<p>Абдулатиф Жуpаев</p>
							<p>Максат Кошоев</p>
							<p>Казис Бекиш уулу</p>
							<p>Туйгунбай Эргешов</p>
							<p>&nbsp;</p>
							<p><strong>Аткаруу Кеңеши :</strong></p>
							<p>Мирланбек Нурматов</p>
							<p>Өмер Күчүк Мехмет уулу</p>
							<p>Бахтияр Караев</p>
							<p>София Хаджиназарова</p>
							</div>',
			'lang'       => 'kg',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')]
		);

		// Uncomment the below to run the seeder
		DB::table('pages')->insert($pages);
	}

}
