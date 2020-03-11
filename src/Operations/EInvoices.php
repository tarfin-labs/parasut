<?php

namespace TarfinLabs\Parasut\Operations;

use TarfinLabs\Parasut\ApiClient;
use TarfinLabs\Parasut\Exceptions\ParasutException;
use GuzzleHttp\Exception\ClientException;

class EInvoices extends AbstractOperation
{
    protected $endPoint = 'e_invoices';

    public function __construct(ApiClient $client)
    {
        parent::__construct($client);
    }

    public function downloadXmls($ids)
    {
        $this->clearFolderContent();

        foreach ($ids as $id) {
            $xml = $this->getXml($id);
            $this->write($id, $xml);
        }

        $this->zipXmls();
    }

    private function clearFolderContent()
    {
        $files = glob(__DIR__.'/downloads/*');

        foreach ($files as $file) { // iterate files
            if (is_file($file)) {
                unlink($file); // delete file
            }
        }
    }

    public function getXml($id)
    {
        try {
            return $this->client->getXml('GET', $this->endPoint.'/'.$id.'/'.'signed_ubl');
        } catch (ClientException $exception) {
            $code = $exception->getCode();
            if ($code == 429) {
                //echo "Waiting for 60 sec. because of parasut rate limit!!\n";
                sleep(60);

                return $this->getXml($id);
            }
            throw call_user_func(ParasutException::class.'::_'.$code, $exception);
        }
    }

    private function write($id, $xml)
    {
        $file = fopen(__DIR__.'/downloads/'.$id.'_ubl.xml', 'w');
        fwrite($file, $xml);
        fclose($file);
    }

    private function zipXmls()
    {
        $zip = new \ZipArchive();
        if ($zip->open('/tmp/xmls.zip', \ZipArchive::CREATE) === true) {
            $files = glob(__DIR__.'/downloads/*');

            foreach ($files as $file) { // iterate files
                if (is_file($file)) {
                    $zip->addFile($file);
                }
            }

            // All files are added, so close the zip file.
            $zip->close();
        }
    }
}
