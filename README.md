# Aras Kargo Entegrasyon Modülü PHP Laravel

Laravel tabanlı yazdığım aras kargo entegrasyon kütüphanesi. Tek parça ürün gönderimi için hazırlanmıştır. Birden fazla ürün gönderimi için xml kısmının güncellenmesi gerekiyor. 

Entegrasyon veya destek için issue açabilir, [@devredisibirak](http://twitter.com/devredisibirak) twitter hesabımdan bana ulaşabilirsiniz.

## Kurulum

	namespace App\Http\Controllers;

	use Illuminate\Http\Request;

	use App\Http\Requests;

	use App\Http\Controllers\Controller;

	use App\Libraries\Cargo\Arax;

	class TestController extends Controller
	{
		public function getIndex()
		{		
			$orders_no="ÖRNEK SİPARİŞ NO";
			$aras=new Arax();
			$aras->setUsername("TEST USERNAME");
			$aras->setPassword("TEST PASSWORD");
			$aras->setURL("http://customerservicestest.araskargo.com.tr/arascargoservice/arascargoservice.asmx");

			$aras->setIntegrationCode($orders_no);
			$aras->setInvoiceNumber($orders_no);
			$aras->setTradingWaybillNumber($orders_no);
			$aras->setPieceCount("1");
			$aras->setDescription("TANIM");//Zorunlu Değil

			$aras->setReceiverName("AD SOYAD");
			$aras->setReceiverPhone1("05344516488");

			$aras->setReceiverTownName("İLÇE");
			$aras->setReceiverAddress("ADRES");
			$aras->setReceiverCityName("İL");
			$aras->setIsWorldWide("0"); //Yurtiçi için 0 Yurtdışı için 1
			
			$aras->setCodCollectionType(0);//Tahsilatlı teslimat ürünü ödeme tipi (0=Nakit,1=Kredi Kartı)
            $aras->setPayorTypeCode(1);//Gönderinin ödemesini kimin yapacağını belirler. (1=Gönderici Öder, 2=Alıcı Öder)
            $aras->setCodAmount("127.20");
            $aras->setIsCod(1);//IsCod	String(1)	'Tahsilatlı Kargo' gönderisi (0=Hayır, 1=Evet)	Hayır
            $aras->setPieceCount(1);//PieceCount	Integer(2)	Sevkedilen Kargo Sayısı

			$items=array();
			$item_1=[
				"BarcodeNumber"=>"test barkod"
			];
			$item_2=[
				"BarcodeNumber"=>"test barkod"
			];
			$items[]=$item_1;
			$items[]=$item_2;

			$aras->setPieceDetail($items);


			$result=$aras->check();
		}
	}
