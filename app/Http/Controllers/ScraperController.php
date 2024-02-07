<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Cookie\CookieJar;

class ScraperController extends Controller {

    public function scrapeIt() {
        $url = 'https://www.fastpeoplesearch.com/name/abdiwak_addis';

        $proxy = 'http://37.19.199.150:8080';

        $headers = [
            'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36 OPR/106.0.0.0',
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
            'Accept-Encoding' => 'gzip, deflate, br',
            'Accept-Language' => 'en-US,en;q=0.9',
            'Referer' => 'https://www.fastpeoplesearch.com/'

            // Add any other headers as needed
        ];

        $cookiesArray = [
            "_uc_referrer" => "direct",
            "_gid" => "GA1.2.1640535721.1707249453",
            "ALLOW_COOKIES" => "true",
            "_lr_env_src_ats" => "false",
            "pbjs_li_nonid" => "%7B%7D",
            "pbjs_li_nonid_cst" => "zix7LPQsHA%3D%3D",
            "gcid_first" => "293f37f1-09b6-4b71-92d8-16c5de4e8d0d",
            "__cf_bm" => "qSoNHM6KoSMp_wKk_wwDrUYE2TyVkJIOtavaXleTDkc-1707253416-1-AS6Gsm+0ON9cB3NjtlT6Jk86At63cOlZpJVIClEDTwMWBq3t22h1Nh0ushkURkQxoBUvkWZXNtiXzxF9BVkqHIM=",
            "cf_clearance" => "qovJLrFEPffB2W39Uea47rK3m6wuGkTSwx9JAVCnYiY-1707253419-1-AV9np0iBt01br6E+vqLeEUfOwnaOEmXTEvHI216U6KCFTJsrJqe5rUtOSy0S0yRRKTHcc4Au+iFbjvBbrBb04S4=",
            "__gads" => "ID=1c79d801193f510c:T=1707253418:RT=1707253418:S=ALNI_MboGotIm_m3okPJVwneeHhZs3rxZw",
            "__gpi" => "UID=00000dbfeebb1c64:T=1707253418:RT=1707253418:S=ALNI_MZfvJj41V8QTa6Ah5qw6kCb94DltQ",
            "__eoi" => "ID=500f8bc60f5daf55:T=1707253418:RT=1707253418:S=AA-AfjZwb78Cn9F6u4G7wjR0CUQI",
            "_ga_CNSJ7NJVG1" => "GS1.1.1707253419.2.1.1707253465.0.0.0",
            "_ga" => "GA1.2.2108796628.1707249453",
            "_lr_retry_request" => "true",
            "_cc_id" => "f058162eff036db6cbf2a359bffe2cf",
            "panoramaId" => "186743b147fc34dc67608e9d25c2a9fb927a4923a7fba6f459b4fd92c653f595",
            "panoramaIdType" => "panoDevice",
            "FCNEC" => "%5B%5B%22AKsRol8Xu1Dnnz26_1DoRTfu9l4Jo8TvN_GhmyvwYEKH20SB6u1xNJfVv2B5YcWrRdYAXGCNH4vttybv6c2RDvr22fb1yVZBs5-BIIwmGIeoBXcNloGhzZ_PrRw9IdVP-rjiqCPFCK4dFgrfMGWjc7fOQ4sOvJGm6A%3D%3D%22%5D%5D",
            "_tfpvi" => "NWU3OGUzYjktYWM4Ni00ZmU0LTk2MzktNzBlZGI4ZGI1ZmNjIzQtOA%3D%3D",
            "panoramaId_expiry" => "1707339868898",
            "__qca" => "P0-230206700-1707253466055",
            "cto_bundle" => "DMIpNV9XU0dJMG4yc01XWmpoNWdaY1k5ZWg1cmJHbXBSMHlJZGZGMUNRVlZrVGF6M25hUk45MnR0SFdySTVaMTlIejdRRFM2V3diTTFnWm5RYkQ4dWRqcW1pc3RRMU15WFlkT3pFMUhHVHFzZTNmMThLZWlOT3pTMDhScmhFTG80ckhnbQ",
            "cto_bidid" => "eOzcnV9LQVVxMWF4MVlCbEQ0ZlRkWk5KOW01WjYlMkZqYUZlQXFkMkNsSmNDUWxzakpVeGRxNnYlMkZmNE80WXRURUNDYVFRbVFINkQzR3FhMEZnMUIlMkYxOEg0MlpVZEgwTFNKOGJ6eG15QUVDTU5WNFIzdyUzRA"
        ];

        // Create a new CookieJar instance and populate it with the cookies
        $cookies = CookieJar::fromArray($cookiesArray, $url);

        $client = new Client();
        $response = $client->request('GET', $url, [
            RequestOptions::HEADERS => $headers,
            RequestOptions::COOKIES => $cookies,
            RequestOptions::PROXY => $proxy
        ]);
        $html = $response->getBody()->getContents();

        // return $html;

        $crawler = new Crawler($html);

        // Example: Extracting titles
        $titles = $crawler->filter('h2')->each(function ($node) {
            return $node->text();
        });

        // Process $titles or any other data extracted as needed

        return response()->json($titles);
    }
}
