<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Exception\RequestException;

// require_once 'vendor/autoload.php';

use Nesk\Puphpeteer\Puppeteer;


class ScraperController extends Controller {

    // public function scrapeIt() {

    //     // Initialize Puppeteer
    //     // $puppeteer = new Puppeteer();

    //     $url = 'https://www.fastpeoplesearch.com/name/abdiwak_addis';

    //     $headers = [
    //         'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
    //         'Accept-Encoding' => 'gzip, deflate, br',
    //         'Accept-Language' => 'en-US,en;q=0.9',
    //         // 'Cookie' => '_uc_referrer=direct; _gid=GA1.2.1640535721.1707249453; ALLOW_COOKIES=true; _lr_env_src_ats=false; pbjs_li_nonid=%7B%7D; pbjs_li_nonid_cst=zix7LPQsHA%3D%3D; gcid_first=293f37f1-09b6-4b71-92d8-16c5de4e8d0d; cf_clearance=qovJLrFEPffB2W39Uea47rK3m6wuGkTSwx9JAVCnYiY-1707253419-1-AV9np0iBt01br6E+vqLeEUfOwnaOEmXTEvHI216U6KCFTJsrJqe5rUtOSy0S0yRRKTHcc4Au+iFbjvBbrBb04S4=; _cc_id=f058162eff036db6cbf2a359bffe2cf; panoramaId=186743b147fc34dc67608e9d25c2a9fb927a4923a7fba6f459b4fd92c653f595; panoramaIdType=panoDevice; panoramaId_expiry=1707339868898; __qca=P0-230206700-1707253466055; _ga_CNSJ7NJVG1=GS1.1.1707253419.2.1.1707254889.0.0.0; _ga=GA1.2.2108796628.1707249453; __gads=ID=1c79d801193f510c:T=1707253418:RT=1707254889:S=ALNI_MboGotIm_m3okPJVwneeHhZs3rxZw; __gpi=UID=00000dbfeebb1c64:T=1707253418:RT=1707254889:S=ALNI_MZfvJj41V8QTa6Ah5qw6kCb94DltQ; __eoi=ID=500f8bc60f5daf55:T=1707253418:RT=1707254889:S=AA-AfjZwb78Cn9F6u4G7wjR0CUQI; _tfpvi=ZTg2NTAwZjQtMDM2MS00NTg1LWJmMzAtOTQzOTAzOGIwMGI1Iy03LTk%3D; cto_bundle=BoXRgF9XU0dJMG4yc01XWmpoNWdaY1k5ZWh3RldKYU0lMkJoU3o1N1JKbVFnZ1plUHRMdEloaXZ2MzNDdVVlc25Nc0tjMCUyQkxycHhseWpwZklnaSUyQmpsTG1rcWdUWDVqbEs0Z2diaHRjMFVsY0NRdHJ0S092R3RXNWQ3cFVSJTJGaUtlUFYlMkJudyUyQkF6MlROOG1PQTZ3UVQ4YTFCdkpRTWFMQmR5RzZJOVRRSU10ekRqNmZlSzAlM0Q; cto_bidid=cjM6Sl9LQVVxMWF4MVlCbEQ0ZlRkWk5KOW01WjYlMkZqYUZlQXFkMkNsSmNDUWxzakpVeGRxNnYlMkZmNE80WXRURUNDYVFRbTVheiUyRkp0WkVTNTBQY2c0Vmt4T2pUQnhlWUU3MGZTdXJ4RlhVVkhQU3FzOU9BdFZlRlJRRFpTOW9zaGxDRFRkYw; FCNEC=%5B%5B%22AKsRol__GbRizu3uux7zssFEyJdPihNd_zUQHxXdJ5SF5mhgXfCeGkrAyIuT7uMNYMP2iBtKXWO26oSd0LgRpEK69O7Z3hItExh6pZ4iE6LLbXPDpxSmGQ86XCsNt38rptUmZPz86ZOqMXvslLFTxNwfiNqaiiRAig%3D%3D%22%5D%5D',
    //         'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36'
    //     ];

    //     $cookiesArray = [
    //         "_uc_referrer" => "direct",
    //         "_gid" => "GA1.2.1640535721.1707249453",
    //         "ALLOW_COOKIES" => "true",
    //         "_lr_env_src_ats" => "false",
    //         "pbjs_li_nonid" => "%7B%7D",
    //         "pbjs_li_nonid_cst" => "zix7LPQsHA%3D%3D",
    //         "gcid_first" => "293f37f1-09b6-4b71-92d8-16c5de4e8d0d",
    //         "__cf_bm" => "qSoNHM6KoSMp_wKk_wwDrUYE2TyVkJIOtavaXleTDkc-1707253416-1-AS6Gsm+0ON9cB3NjtlT6Jk86At63cOlZpJVIClEDTwMWBq3t22h1Nh0ushkURkQxoBUvkWZXNtiXzxF9BVkqHIM=",
    //         "cf_clearance" => "qovJLrFEPffB2W39Uea47rK3m6wuGkTSwx9JAVCnYiY-1707253419-1-AV9np0iBt01br6E+vqLeEUfOwnaOEmXTEvHI216U6KCFTJsrJqe5rUtOSy0S0yRRKTHcc4Au+iFbjvBbrBb04S4=",
    //         "__gads" => "ID=1c79d801193f510c:T=1707253418:RT=1707253418:S=ALNI_MboGotIm_m3okPJVwneeHhZs3rxZw",
    //         "__gpi" => "UID=00000dbfeebb1c64:T=1707253418:RT=1707253418:S=ALNI_MZfvJj41V8QTa6Ah5qw6kCb94DltQ",
    //         "__eoi" => "ID=500f8bc60f5daf55:T=1707253418:RT=1707253418:S=AA-AfjZwb78Cn9F6u4G7wjR0CUQI",
    //         "_ga_CNSJ7NJVG1" => "GS1.1.1707253419.2.1.1707253465.0.0.0",
    //         "_ga" => "GA1.2.2108796628.1707249453",
    //         "_lr_retry_request" => "true",
    //         "_cc_id" => "f058162eff036db6cbf2a359bffe2cf",
    //         "panoramaId" => "186743b147fc34dc67608e9d25c2a9fb927a4923a7fba6f459b4fd92c653f595",
    //         "panoramaIdType" => "panoDevice",
    //         "FCNEC" => "%5B%5B%22AKsRol8Xu1Dnnz26_1DoRTfu9l4Jo8TvN_GhmyvwYEKH20SB6u1xNJfVv2B5YcWrRdYAXGCNH4vttybv6c2RDvr22fb1yVZBs5-BIIwmGIeoBXcNloGhzZ_PrRw9IdVP-rjiqCPFCK4dFgrfMGWjc7fOQ4sOvJGm6A%3D%3D%22%5D%5D",
    //         "_tfpvi" => "NWU3OGUzYjktYWM4Ni00ZmU0LTk2MzktNzBlZGI4ZGI1ZmNjIzQtOA%3D%3D",
    //         "panoramaId_expiry" => "1707339868898",
    //         "__qca" => "P0-230206700-1707253466055",
    //         "cto_bundle" => "DMIpNV9XU0dJMG4yc01XWmpoNWdaY1k5ZWg1cmJHbXBSMHlJZGZGMUNRVlZrVGF6M25hUk45MnR0SFdySTVaMTlIejdRRFM2V3diTTFnWm5RYkQ4dWRqcW1pc3RRMU15WFlkT3pFMUhHVHFzZTNmMThLZWlOT3pTMDhScmhFTG80ckhnbQ",
    //         "cto_bidid" => "eOzcnV9LQVVxMWF4MVlCbEQ0ZlRkWk5KOW01WjYlMkZqYUZlQXFkMkNsSmNDUWxzakpVeGRxNnYlMkZmNE80WXRURUNDYVFRbVFINkQzR3FhMEZnMUIlMkYxOEg0MlpVZEgwTFNKOGJ6eG15QUVDTU5WNFIzdyUzRA"
    //     ];

    //     // Create a new CookieJar instance and populate it with the cookies
    //     $cookies = CookieJar::fromArray($cookiesArray, $url);

    //     // Instantiate Guzzle client with proxy configuration
    //     // $client = new Client([
    //     //     'base_uri' => 'https://www.fastpeoplesearch.com/',
    //     //     // 'proxy' => 'http://154.12.253.232:54506', 
    //     //     // 'handler' => HandlerStack::create(),
    //     //     // 'verify' => false, // Disable SSL verification if needed
    //     // ]);

    //     // $api = 'name/abdiwak_addis';


    //     $client = new Client();

    //     $response = $client->request('GET', $url, [
    //         // RequestOptions::HEADERS => $headers,
    //         // RequestOptions::COOKIES => $cookies,
    //         // RequestOptions::PROXY => $proxy
    //     ]);
    //     $html = $response->getBody()->getContents();

    //     $crawler = new Crawler($html);

    //     // Example: Extracting titles
    //     $titles = $crawler->filter('h2')->each(function ($node) {
    //         return $node->text();
    //     });

    //     // Process $titles or any other data extracted as needed

    //     return response()->json($titles);
    // }


    public function testScrap() {

        $url = 'https://www.fastpeoplesearch.com/daniel-eyob_id_G-3956879193660365613';
        $cookieHeader = '_uc_referrer=direct; _gid=GA1.2.1640535721.1707249453; ALLOW_COOKIES=true; _lr_env_src_ats=false; gcid_first=293f37f1-09b6-4b71-92d8-16c5de4e8d0d; _cc_id=f058162eff036db6cbf2a359bffe2cf; __qca=P0-230206700-1707253466055; _au_1d=AU1D-0100-001707282800-HGSQRQTF-AH4E; FCCDCF=%5Bnull%2Cnull%2Cnull%2C%5B%22CP5m9AAP5m9AAEsACBENAmEoAP_gAEPgABBYINJD7D7FbSFCwHpzaLsAMAhHRsCAQoQAAASBAmABQAKQIAQCgkAQFASgBAACAAAAICZBIQAECAAACUAAQAAAAAAEAAAAAAAIIAAAgAEAAAAIAAACAAAAEAAIAAAAEAAAmAgAAIIACAAAhAAAAAAAAAAAAAAAAgAAAAAAAAAAAAAAAAAAAQOhQD2F2K2kKFkPCmQWYAQBCijYEAhQAAAAkCBIAAgAUgQAgFIIAgAIFAAAAAAAAAQEgCQAAQABAAAIACgAAAAAAIAAAAAAAQQAAAAAIAAAAAAAAEAAAAAAAQAAAAIAABEhCAAQQAEAAAAAAAQAAAAAAAAAAABAAA%22%2C%222~2072.70.89.93.108.122.149.196.2253.2299.259.2357.311.313.323.2373.338.358.2415.415.449.2506.2526.486.494.495.2568.2571.2575.540.574.2624.609.2677.864.981.1029.1048.1051.1095.1097.1126.1201.1205.1211.1276.1301.1344.1365.1415.1423.1449.1451.1570.1577.1598.1651.1716.1735.1753.1765.1870.1878.1889.1958~dv.%22%2C%2252DE7854-9ED1-4B47-B736-0C795A31F327%22%5D%5D; _au_last_seen_iab_tcf=1707333927777; pbjs_li_nonid_cst=myypLK4sUw%3D%3D; pbjs_li_nonid=%7B%22nonId%22%3A%22CHILhKM5b8BvKJHFOwxDVRQ4g1H5dnjkm0kP1Q%22%7D; panoramaId=186743b147fc34dc67608e9d25c2a9fb927a4923a7fba6f459b4fd92c653f595; panoramaIdType=panoDevice; panoramaId_expiry=1707427620274; _au_last_seen_pixels=eyJhcG4iOjE3MDczNDEyMjIsInR0ZCI6MTcwNzM0MTIyMiwicHViIjoxNzA3MzQxMjIyLCJydWIiOjE3MDczNDEyMjIsInRhcGFkIjoxNzA3MzQxMjIyLCJhZHgiOjE3MDczNDEyMjIsImdvbyI6MTcwNzM0MTIyMiwiaW5kZXgiOjE3MDczNDEyMjIsIm9wZW54IjoxNzA3MzQxMjIyLCJhZG8iOjE3MDczNDEyMjIsInNvbiI6MTcwNzMzMzkyNSwicHBudCI6MTcwNzMzMzkyNSwidW5ydWx5IjoxNzA3MzMzOTI1LCJ0YWJvb2xhIjoxNzA3MzMzOTI1LCJhbW8iOjE3MDczMzM5MjUsImltcHIiOjE3MDczMzM5MjUsImJlZXMiOjE3MDczMzM5MjUsInNtYXJ0IjoxNzA3MzMzOTI1LCJjb2xvc3N1cyI6MTcwNzMzMzkyNX0%3D; __eoi=ID=500f8bc60f5daf55:T=1707253418:RT=1707344904:S=AA-AfjZwb78Cn9F6u4G7wjR0CUQI; cf_clearance=Az71xoSHhtXAv7l8UQqNtSvd9IOMUZxXI0lLxYgUuDo-1707345112-1-ATraZOBzQ8gF9O/IWFfC1mG1Vmarxl/JoEu9yQjU0JDrft6zMWFsB8Hdf0rYweut9W4jMe2pAeIahv7Ygww96eA=; __cf_bm=mrnP5xM.YRmWNGe2dOVVAGHu.luwKWGj8QvxRuQwn5k-1707346858-1-AdeY7ychTvAWYeDA9QGTHS+TtJGNcRw9hvdfl2SOtdrobkdnp9CW8Y1EYunbZQzpvMet12uJlpjXyVN4IuKD+9U=; _ga_CNSJ7NJVG1=GS1.1.1707331600.5.1.1707346862.0.0.0; _ga=GA1.2.2108796628.1707249453; _dc_gtm_UA-103774020-1=1; _lr_retry_request=true; __gads=ID=1c79d801193f510c:T=1707253418:RT=1707346863:S=ALNI_MboGotIm_m3okPJVwneeHhZs3rxZw; __gpi=UID=00000dbfeebb1c64:T=1707253418:RT=1707346863:S=ALNI_MZfvJj41V8QTa6Ah5qw6kCb94DltQ; _tfpvi=ZjU2NDQwMzEtMDY5Ny00ZGQzLTg2ZGUtMThmYTQwNDJjMGQ5Iy0zLTc%3D; cto_bundle=3EVUTV9XU0dJMG4yc01XWmpoNWdaY1k5ZWh6dW5yNjUxS2tqZzZIMzBBb280OG5PZ09Lc28lMkJ0M1NRMnNvMzhtdlZobU5NNllvWWpJWnVxRUR3R05EJTJGclFxUndIWWFtMkg4ZVNkSUFKYlBqVmJ3Q3NxajRWV25zenBLY3pLcVhKOUdEajFTTktkUVJWSkMlMkIzbnR0T0ZISzBrVk55TDV0Q2pVMHB4T2pSVG1OanVXaGslM0Q; cto_bidid=gxKhvV9LQVVxMWF4MVlCbEQ0ZlRkWk5KOW01WjYlMkZqYUZlQXFkMkNsSmNDUWxzakpVeGRxNnYlMkZmNE80WXRURUNDYVFRbTVheiUyRkp0WkVTNTBQY2c0Vmt4T2pUQnhlWUU3MGZTdXJ4RlhVVkhQU3FzODZQRSUyQmxKUVlvbUpCamZCMFVIbFZJ; FCNEC=%5B%5B%22AKsRol-YNStV7IrV9XwqyOoGmb5ihHklLMXsUi9f3--JfFyPEvtsEpj2QKYncEt6jGLXq5vGPRDyW-otzCVvJVyFCTsZ7JP8b-nw1UUdOKm1kDuTR_1XW2qkj5757b5Cqd7kITNuLX-J9P32JZgJE5ZKIOj_IwrQ5A%3D%3D%22%5D%5D';

        $cookiesArray = [];
        foreach (explode('; ', $cookieHeader) as $cookie) {
            list($name, $value) = explode('=', $cookie, 2);
            $cookiesArray[$name] = $value;
        }

        $cookies = CookieJar::fromArray($cookiesArray, $url);

        $headers = [
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
            'Accept-Encoding' => 'gzip, deflate, br',
            'Accept-Language' => 'en-US,en;q=0.9',
            'Cookie' => $cookieHeader,
            // 'Referer' => 'https://www.fastpeoplesearch.com/',
            'If-Modified-Since' => 'Wed, 07 Feb 2024 21:40:35 GMT',
            'Sec-Ch-Ua' => '"Not A(Brand";v="99", "Google Chrome";v="121", "Chromium";v="121"',
            'Sec-Ch-Ua-Mobile' => '?0',
            'Sec-Ch-Ua-Platform' => '"macOS"',
            'Sec-Fetch-Dest' => 'document',
            'Sec-Fetch-Mode' => 'navigate',
            'Sec-Fetch-Site' => 'none',
            'Sec-Fetch-User' => '?1',
            'Upgrade-Insecure-Requests' => '1',
            'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36',
        ];

        $client = new Client();

        $response = $client->request('GET', $url, [
            RequestOptions::HEADERS => $headers,
            // RequestOptions::COOKIES => $cookies,
        ]);

        $html = $response->getBody()->getContents();
        // return $html;

        $crawler = new Crawler($html);

        // Extracting Fullname
        $fullname = $crawler->filter('.fullname')->each(function ($node) {
            return $node->text();
        });

        // Age Extract
        $age = $crawler->filter('#age-header')->each(function ($node) {
            $ageString = $node->text();
            return str_replace("Age ", "", $ageString);
        });

        // Current Address Section
        $currentAddress = $crawler->filter('#current-addresses-property .detail-box-content h3')->each(function ($addNode) {
            return $addNode->text();
        });

        // Previous Address
        $preAddresses = $crawler->filter('.address-link a')->each(function ($addressNode) {
            return $addressNode->text();
        });


        // Extracting Phone Number
        $phoneDetails = $crawler->filter('.detail-box-phone dl')->each(function ($dlNode) {
            // Initialize an array to store details for this dl tag
            $details = [];

            // Find dt tags within this dl tag
            $dtNodes = $dlNode->filter('dt');

            // Iterate over dt tags
            $dtNodes->each(function ($dtNode) use (&$details) {
                // Find the a tag within the dt tag, if it exists
                $aNode = $dtNode->filter('a');

                // If a tag exists within dt tag, retrieve its text content and add to details array
                if ($aNode->count() > 0) {
                    $details[] = $aNode->text();
                }
            });

            return $details;
        });
        // Flatten the array of arrays into a single array
        $phoneNumbers = array_merge(...$phoneDetails);

        // Extracting Email
        $emailDetails = $crawler->filter('#email_section .detail-box-email h3')->each(function ($emailNode) {
            // Initialize an array to store details for this dl tag
            $emails = [];

            if ($emailNode->count() > 0) {
                $emails[] = $emailNode->text();
            }

            return $emails;
        });
        $emailAddresses = array_merge(...$emailDetails);

        // Extracting AKA
        $akaLinks = $crawler->filter('h3')->each(function ($akaNode) {
            return $akaNode;
        });

        $relativeLinks = $crawler->filter('#relative-links .detail-box-content dl dt a')->each(function ($linkNode) {
            return $linkNode->text();
        });

        $associateLinks = $crawler->filter('#associate-links .detail-box-content dl dt a')->each(function ($associateNode) {
            return $associateNode->text();
        });

        $businesses = $crawler->filter('#business_section .detail-box-content dl dt')->each(function ($businessNode) {
            return $businessNode->text();
        });

        $currentEmployment = $crawler->filter('#current_employment_section dl')->each(function ($empNode) {
            return $empNode->text();
        });

        $workExp = $crawler->filter('#work_experience_section dl')->each(function ($workNode) {
            return $workNode->text();
        });

        $education = $crawler->filter('#education_section dl')->each(function ($eduNode) {
            return $eduNode->text();
        });

        $report = $crawler->filter('#background_report_section')->each(function ($reportNode) {
            return $reportNode->text();
        });

        return response()->json($report);
    }
}
