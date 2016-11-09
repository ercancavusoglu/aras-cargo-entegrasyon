# Aras Kargo Entegrasyon Modülü PHP Laravel

===

Laravel tabanlı yazdığım aras kargo entegrasyon kütüphanesi. Tek parça ürün gönderimi için hazırlanmıştır. Birden fazla ürün gönderimi için xml kısmının güncellenmesi gerekiyor. 

Entegrasyon veya destek için issue açabilir, `ercancavusoglu@yandex.com.tr` adresinden veya [@devredisibirak](http://twitter.com/devredisibirak) twitter hesabımdan bana ulaşabilirsiniz.

## Kurulum

	use App\Libraries\Cargo\Arax;

	```php
		
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

        $result=$aras->check();
	```
