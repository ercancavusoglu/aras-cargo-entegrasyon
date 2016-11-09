<?php

namespace App\Libraries\Cargo;

class Arax
{

    protected $URL;

    //Web Servis Kullanıcı Adınız
    protected $Username;

    //Web Servis Kullanıcı Şifreniz
    protected $Password;

    //Fatura No     String(20)
    protected $InvoiceNumber;

    //Alıcı Adı     String(200)
    protected $ReceiverName;

    //Alıcı Adresi (String şeklinde toplu adres bilgisi)        String(250)
    protected $ReceiverAddress;

    //Telefon-1     String(10)
    protected $ReceiverPhone1;

    //İl-Şehir Adı      String(40)
    protected $ReceiverCityName;
    //İlçe Adı      String(16)
    protected $ReceiverTownName;

    //Sipariş Kodu /Entegrasyon Kodu (mök ) String(32)
    protected $IntegrationCode;

    //Sevk İrsaliye No.     String(16)
    protected $TradingWaybillNumber;

    //Sevkedilen Kargo Sayısı       Integer(2)
    protected $PieceCount;

    //Yurtdışı gönderisi mi (0=Yurtiçi, 1=Yurtdışı) Required
    protected $IsWorldWide;

    //Tanım
    protected $Description;

    /**
     * @return string
     */
    public function getURL()
    {
        return $this->URL;
    }

    /**
     * @param string $URL
     */
    public function setURL($URL)
    {
        $this->URL = $URL;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->Username;
    }

    /**
     * @param string $Username
     */
    public function setUsername($Username)
    {
        $this->Username = $Username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->Password;
    }

    /**
     * @param string $Password
     */
    public function setPassword($Password)
    {
        $this->Password = $Password;
    }

    /**
     * @return mixed
     */
    public function getInvoiceNumber()
    {
        return $this->InvoiceNumber;
    }

    /**
     * @param mixed $InvoiceNumber
     */
    public function setInvoiceNumber($InvoiceNumber)
    {
        $this->InvoiceNumber = $InvoiceNumber;
    }

    /**
     * @return mixed
     */
    public function getReceiverName()
    {
        return $this->ReceiverName;
    }

    /**
     * @param mixed $ReceiverName
     */
    public function setReceiverName($ReceiverName)
    {
        $this->ReceiverName = $ReceiverName;
    }

    /**
     * @return mixed
     */
    public function getReceiverPhone1()
    {
        return $this->ReceiverPhone1;
    }

    /**
     * @param mixed $ReceiverPhone1
     */
    public function setReceiverPhone1($ReceiverPhone1)
    {
        $this->ReceiverPhone1 = $ReceiverPhone1;
    }

    /**
     * @return mixed
     */
    public function getReceiverCityName()
    {
        return $this->ReceiverCityName;
    }

    /**
     * @param mixed $ReceiverCityName
     */
    public function setReceiverCityName($ReceiverCityName)
    {
        $this->ReceiverCityName = $ReceiverCityName;
    }

    /**
     * @return mixed
     */
    public function getReceiverTownName()
    {
        return $this->ReceiverTownName;
    }

    /**
     * @param mixed $ReceiverTownName
     */
    public function setReceiverTownName($ReceiverTownName)
    {
        $this->ReceiverTownName = $ReceiverTownName;
    }

    /**
     * @return mixed
     */
    public function getReceiverAddress()
    {
        return $this->ReceiverAddress;
    }

    /**
     * @param mixed $ReceiverAddress
     */
    public function setReceiverAddress($ReceiverAddress)
    {
        $this->ReceiverAddress = $ReceiverAddress;
    }

    /**
     * @return mixed
     */
    public function getIntegrationCode()
    {
        return $this->IntegrationCode;
    }

    /**
     * @param mixed $IntegrationCode
     */
    public function setIntegrationCode($IntegrationCode)
    {
        $this->IntegrationCode = $IntegrationCode;
    }

    /**
     * @return mixed
     */
    public function getTradingWaybillNumber()
    {
        return $this->TradingWaybillNumber;
    }

    /**
     * @param mixed $TradingWaybillNumber
     */
    public function setTradingWaybillNumber($TradingWaybillNumber)
    {
        $this->TradingWaybillNumber = $TradingWaybillNumber;
    }

    /**
     * @return mixed
     */
    public function getPieceCount()
    {
        return $this->PieceCount;
    }

    /**
     * @param mixed $PieceCount
     */
    public function setPieceCount($PieceCount)
    {
        $this->PieceCount = $PieceCount;
    }

    /**
     * @return mixed
     */
    public function getIsWorldWide()
    {
        return $this->IsWorldWide;
    }

    /**
     * @param mixed $IsWorldWide
     */
    public function setIsWorldWide($IsWorldWide)
    {
        $this->IsWorldWide = $IsWorldWide;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->Description;
    }

    /**
     * @param mixed $Description
     */
    public function setDescription($Description)
    {
        $this->Description = $Description;
    }

    public function check()
    {
        $output = $this->xmlGonder($this->xmlDetails(), $this->URL);
        // converting
        $response1 = str_replace("<soap:Body>", "", $output);
        $response2 = str_replace("</soap:Body>", "", $response1);

        // convertingc to XML
        $parser = simplexml_load_string($response2);

        $ResultCode = (string)$parser->SetOrderResponse->SetOrderResult->OrderResultInfo->ResultCode;
        $ResultMessage = (string)$parser->SetOrderResponse->SetOrderResult->OrderResultInfo->ResultMessage;
        //$InvoiceKey=(string) $this->result->SetOrderResponse->SetOrderResult->OrderResultInfo->InvoiceKey;
        //$OrgReceiverCustId=(string) $this->result->SetOrderResponse->SetOrderResult->OrderResultInfo->OrgReceiverCustId;

        return [
            "ResultCode" => $ResultCode,
            "ResultMessage" => $ResultMessage
        ];
    }


    protected function xmlGonder($xml, $url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml;charset=utf-8'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $cevap = curl_exec($ch);
        curl_close($ch);

        return $cevap;
    }


    protected function xmlDetails()
    {

        $xml_data = '<?xml version="1.0" encoding="UTF-8"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
   <soap:Body>
      <SetOrder xmlns="http://tempuri.org/">
      <orderInfo>
        <Order>
          <UserName>' . $this->getUsername() . '</UserName>
          <Password>' . $this->getPassword() . '</Password>
          <TradingWaybillNumber>' . $this->getTradingWaybillNumber() . '</TradingWaybillNumber>
          <InvoiceNumber>' . $this->getInvoiceNumber() . '</InvoiceNumber>
          <ReceiverName>' . $this->getReceiverName() . '</ReceiverName>
          <ReceiverAddress>' . $this->getReceiverAddress() . '</ReceiverAddress>
          <ReceiverPhone1>' . $this->getReceiverPhone1() . '</ReceiverPhone1>          
          <ReceiverCityName>' . $this->getReceiverCityName() . '</ReceiverCityName>
          <ReceiverTownName>' . $this->getReceiverTownName() . '</ReceiverTownName>
          <VolumetricWeight>1</VolumetricWeight>
          <Weight>1</Weight>
          <PieceCount>' . $this->getPieceCount() . '</PieceCount>
          <IntegrationCode>' . $this->getIntegrationCode() . '</IntegrationCode>
          <Description>' . $this->getDescription() . '</Description>                   
          <IsWorldWide>0</IsWorldWide>
          <PieceDetails>
            <PieceDetail>
                <BarcodeNumber>' . $this->getInvoiceNumber() . '</BarcodeNumber>
            </PieceDetail>            
          </PieceDetails>
          <SenderAccountAddressId />
        </Order>        
      </orderInfo>
      <userName>' . $this->getUsername() . '</userName>
      <password>' . $this->getPassword() . '</password>
    </SetOrder>
  </soap:Body>
</soap:Envelope>';
        return $xml_data;
    }
}