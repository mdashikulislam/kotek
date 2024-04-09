<?php
/*

EXAMPLE:
// parameters are in order
// 1. Zip code shipping TO
// 2. A UPS service #, or leave empty for shop mode
// 3. Number of packages
// 4. Total weight of all packages in US pounds
// 5. Ship date (unix or string)
// 6. Residential (boolean)

$this->load->library('United_parcel_service');
$resultArr = $this->united_parcel_service->get_rate(60504,'',1,2,'12/25/09',true);

*/
class United_parcel_service
{
    // ========== CHANGE THESE VALUES TO MATCH YOUR OWN ===========
    private $access_key='your-access-key';// Your UPS Online Tools Access Key
    private $ups_account_username='your-user-name';// Your UPS Account Username
    private $ups_account_password='your-password';// Your UPS Account Password
    private $zip_code='29615';// Zipcode you are shipping FROM
    private $ups_account_number='your-acount-number';// Your UPS Account Number
    // ============================================================
    public function get_rate($destination_zip, $service_type, $number_of_packages, $weight, $ship_date, $residential)
    {
        $request_option = 'Rate';
        if ($service_type == '')
        {
            $request_option = 'Shop';
        }
        
        if (is_numeric($ship_date))
        {
            $shipDate = date('Y-m-d', $ship_date);
        }
        else
        {
            $shipDate = date('Y-m-d', strtotime($ship_date));
        }

        $resStr = "";
        if ($residential)
        {
            $resStr = "<ResidentialAddressIndicator/>";
        }
        
        if ($number_of_packages > 1)
        {
            $indPackWeight = $weight / $number_of_packages;
            $i = 0;
            $packageCode = '';
            do {
                $packageCode .= "
                    <Package>
                        <PackagingType><Code>02</Code></PackagingType>
                        <PackageWeight>
                            <UnitOfMeasurement><Code>LBS</Code></UnitOfMeasurement>
                            <Weight>$indPackWeight</Weight>
                        </PackageWeight>
                    </Package>
                ";
                $i++;
            }while($i < $number_of_packages);
        }
        else
        {
            $packageCode = "
                <Package>
                    <PackagingType><Code>02</Code></PackagingType>
                    <PackageWeight>
                        <UnitOfMeasurement><Code>LBS</Code></UnitOfMeasurement>
                        <Weight>".$weight."</Weight>
                    </PackageWeight>
                </Package>
            ";
        }
        
        function getstatefromzip($zip5)
        {
            $allstates = array('AK9950099929', 'AL3500036999', 'AR7160072999', 'AR7550275505', 'AZ8500086599', 'CA9000096199', 'CO8000081699', 'CT0600006999', 'DC2000020099', 'DC2020020599', 'DE1970019999', 'FL3200033999', 'FL3410034999', 'GA3000031999', 'HI9670096798', 'HI9680096899', 'IA5000052999', 'ID8320083899', 'IL6000062999', 'IN4600047999', 'KS6600067999', 'KY4000042799', 'KY4527545275', 'LA7000071499', 'LA7174971749', 'MA0100002799', 'MD2033120331', 'MD2060021999', 'ME0380103801', 'ME0380403804', 'ME0390004999', 'MI4800049999', 'MN5500056799', 'MO6300065899', 'MS3860039799', 'MT5900059999', 'NC2700028999', 'ND5800058899', 'NE6800069399', 'NH0300003803', 'NH0380903899', 'NJ0700008999', 'NM8700088499', 'NV8900089899', 'NY0040000599', 'NY0639006390', 'NY0900014999', 'OH4300045999', 'OK7300073199', 'OK7340074999', 'OR9700097999', 'PA1500019699', 'RI0280002999', 'RI0637906379', 'SC2900029999', 'SD5700057799', 'TN3700038599', 'TN7239572395', 'TX7330073399', 'TX7394973949', 'TX7500079999', 'TX8850188599', 'UT8400084799', 'VA2010520199', 'VA2030120301', 'VA2037020370', 'VA2200024699', 'VT0500005999', 'WA9800099499', 'WI4993649936', 'WI5300054999', 'WV2470026899', 'WY8200083199');
            
            foreach ($allstates as $ziprange)
            {
                
                if (($zip5 >= substr($ziprange, 2, 5)) && ($zip5 <= substr($ziprange, 7, 5)))
                {
                    return substr($ziprange, 0, 2);
                }
            }
            
            return;
        }
        $destinationState = getstatefromzip($destination_zip);
        $from_zip = getstatefromzip($this->zip_code);

        $data ="
            <?xml version=\"1.0\"?>
            <AccessRequest xml:lang=\"en-US\">
                <AccessLicenseNumber>" . $this->access_key . "</AccessLicenseNumber>
                <UserId>" . $this->ups_account_username . "</UserId>
                <Password>" . $this->ups_account_password . "</Password>
            </AccessRequest>
            <?xml version=\"1.0\"?>
            <RatingServiceSelectionRequest xml:lang=\"en-US\">
                <Request>
                    <TransactionReference>
                        <CustomerContext>Rate Request From " . $_SERVER['HTTP_HOST'] . "</CustomerContext>
                        <XpciVersion>1.0001</XpciVersion>
                    </TransactionReference>
                    <RequestAction>Rate</RequestAction>
                    <RequestOption>$request_option</RequestOption>
                </Request>
                <PickupType> <Code>01</Code> </PickupType>
                <Shipment>
                    <Shipper>
                        <Address>
                            <PostalCode>" . $this->zip_code . "</PostalCode>
                            <CountryCode>US</CountryCode>
                        </Address>
                        <ShipperNumber>" . $this->ups_account_number . "</ShipperNumber>
                    </Shipper>
                    <ShipTo>
                        <Address>
                        <PostalCode>$destination_zip</PostalCode>
                        <StateProvinceCode>$destinationState</StateProvinceCode>
                        <CountryCode>US</CountryCode>
                        $resStr
                        </Address>
                    </ShipTo>
                    <ShipFrom>
                        <Address>
                        <PostalCode>" . $this->zip_code . "</PostalCode>
                        <StateProvinceCode>$from_zip</StateProvinceCode>
                        <CountryCode>US</CountryCode>
                        </Address>
                    </ShipFrom>
                    <Service>
                        <Code>$service_type</Code>
                    </Service>
                    <ShipmentServiceOptions>
                        <OnCallAir>
                            <Schedule>
                                <PickupDay>$shipDate</PickupDay>
                            </Schedule>
                        </OnCallAir>
                    </ShipmentServiceOptions>
                    $packageCode
                    <RateInformation>
                        <NegotiatedRatesIndicator/>
                    </RateInformation>
                </Shipment>
            </RatingServiceSelectionRequest>
        ";
        
        $ch = curl_init("https://www.ups.com/ups.app/xml/Rate");
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result=curl_exec($ch);
        //echo '<!-- '. $result. ' -->'; // uncomment to debug
        $data = strstr($result, '<?');
        $xml = new SimpleXMLElement($data);

        if ($xml->Response->ResponseStatusCode == '1')
        {
            $shipping_types = array(
                '01' => 'UPS Next Day Air',
                '02' => 'UPS Second Day Air',
                '03' => 'UPS Ground',
                '07' => 'UPS Worldwide Express',
                '08' => 'UPS Worldwide Expedited',
                '11' => 'UPS Standard',
                '12' => 'UPS Three-Day Select',
                '13' => 'Next Day Air Saver',
                '14' => 'UPS Next Day Air Early AM',
                '54' => 'UPS Worldwide Express Plus',
                '59' => 'UPS Second Day Air AM',
                '65' => 'UPS Saver'
            );
            
            $simplifiedArr = array();
            $index = 0;
            foreach ($xml->RatedShipment as $service)
            {
                $simplifiedArr[$index] = "{$service->TotalCharges->MonetaryValue}";
                $index++;
            }
            asort($simplifiedArr);
            foreach ($simplifiedArr as $key => $value)
            {
                $service = $xml->RatedShipment[$key]->children();
                
                if ($service->GuaranteedDaysToDelivery != '')
                {
                    $DeliveryDateStr = date('n/j/y', strtotime($shipDate) + ($service->GuaranteedDaysToDelivery * 86400));
                }
                else
                {
                    $DeliveryDateStr = '';
                }
                
                $rate = number_format((double)($service->TotalCharges->MonetaryValue), 2);
                $shipping_choices["{$service->Service->Code}"] = array("ServiceName" => $shipping_types["{$service->Service->Code}"], "Rate" => "{$rate}", "DeliveryDate" => $DeliveryDateStr);
            }
        
            return $shipping_choices;
        }
        else
        {
            return FALSE;
        }
    }
}  