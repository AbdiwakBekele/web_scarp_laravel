<?php


namespace App\Http\Controllers;

use App\Models\Aka;
use App\Models\Associate;
use App\Models\Business;
use App\Models\Education;
use App\Models\Person;
use App\Models\Phone;
use App\Models\PreviousAddress;
use App\Models\Relative;
use App\Models\Work;
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
        $cookieHeader = '_gid=GA1.2.1521156501.1707351980; _uc_referrer=direct; _lr_retry_request=true; _lr_env_src_ats=false; _cc_id=fa4141bbef3c4fb4efc6d5b97362a04c; panoramaId_expiry=1707438399274; panoramaId=933eec5cb464e390a27c46c057dda9fb927a416a25d4b683cc56e80ecefbbbf3; pbjs_li_nonid=%7B%22nonId%22%3A%22NNV6kDzY5YXpgYeqKC0ObnLacrwQWXjhGl2Zpg%22%7D; gcid_first=ef0e24b0-f15a-43a8-a549-ba3163023d48; _au_1d=AU1D-0100-001707352003-I9V0IAUK-H82W; __qca=P0-761721909-1707352002862; cf_clearance=gqID9Aq01NGXnl8QCySw1ZNZQPj4FKGkymLthIfe_rs-1707352069-1-AVRXyW61vU0lZPo16jHY991vH9o0kkyDHrvvglJwioy64eogDuTtVPZ093AOomo0iwfdu1tSrRH01TR2a08byiM=; ALLOW_COOKIES=true; pbjs_li_nonid_cst=zix7LPQsHA%3D%3D; _au_last_seen_pixels=eyJhcG4iOjE3MDczNTIwMDMsInR0ZCI6MTcwNzM1MjAwMywicHViIjoxNzA3MzUyMDAzLCJydWIiOjE3MDczNTIwMDMsInRhcGFkIjoxNzA3MzUyMDAzLCJhZHgiOjE3MDczNTIwMDMsImdvbyI6MTcwNzM1MjAwMywiaW5kZXgiOjE3MDczNTIwMDMsInNvbiI6MTcwNzM1MjAwMywiYmVlcyI6MTcwNzM1MjAwMywiYWRvIjoxNzA3MzUyMDc1LCJ1bnJ1bHkiOjE3MDczNTIwNzUsIm9wZW54IjoxNzA3MzUyMDc1LCJ0YWJvb2xhIjoxNzA3MzUyMDc1LCJwcG50IjoxNzA3MzUyMDc1LCJjb2xvc3N1cyI6MTcwNzM1MjA3NSwiaW1wciI6MTcwNzM1MjA3NSwiYW1vIjoxNzA3MzUyMDc1LCJzbWFydCI6MTcwNzM1MjA3NX0%3D; __cf_bm=Tn_2sRa8itn8HhDOYdxucV3KvZ97hJ1WeF6up0MKSEA-1707353976-1-AQ50DQUiF1172tuDEUFKF9PyhI4U4e7u1pTOhZN42Bh9xIyJa7sd4lAA6bLexxpOU1bGjwhaFaHKYaqYO2U5vdA=; __gads=ID=fcffad9f5ab4be35:T=1707351980:RT=1707354125:S=ALNI_Ma3rsJDG8zixhoXfoGYeDC8GJ8Q-g; __gpi=UID=00000a0bfd3fd95e:T=1707351980:RT=1707354125:S=ALNI_MZQJx6bn9BwMIsjKgRPEcmKRwhrrQ; __eoi=ID=cfe37f155e62e1b6:T=1707351980:RT=1707354125:S=AA-Afjb6LyczQSirzcwy8J_QV55X; _dc_gtm_UA-103774020-1=1; _ga_CNSJ7NJVG1=GS1.1.1707350798.7.1.1707354289.0.0.0; _tfpvi=N2JkMzcxYTAtZTJiMy00ZjI1LWFlNjYtZDNlZjdkMjA5ZjE0IzMtNA%3D%3D; cto_bundle=BtUSjV9nc2dCJTJCQW80OWJVdDAzbTY5RSUyQlR6VldSUyUyRnVMSm1NWmVRTllDOE9Rd3Y3JTJGVW4zTnhnN3hvOFJ5M09hT2lwJTJGVW9RcTNIbkZTM3RKZDEzS0NtdkJNdVBTMklNSXhEV3FYN3UyTFBqUHBnMmVTdDIzS29wODhJWmVXVFZwR0M3NzMxeFlFZTJZc2tWQkxOOWNDSG1MOW02dWpYTjliM3AxQ0FZT2xvJTJCU1M5cUElM0Q; cto_bidid=G9g8uF9rdEU2VzZKZXlwYmZhQm9NJTJCWlJNVSUyRkl4d3JKNjAxelhnV1Z1Mmk1R09Ic08xZXUxR1FRem5FcW9wZEN5V3RQMTZ4THUlMkZ6elFsRllZV0M4clBCVElMWTJ0ciUyQjdZb1oyQ3oyb0YlMkZKWGpiN2VORlF4ViUyQk83TnhKWERNYVltN1YlMkZr; _ga=GA1.2.1465846399.1707351980; FCNEC=%5B%5B%22AKsRol-piB5PXTL7cHjaGkQdDbXkcZo4a-do3nYH0EhMw2q9Z25vf9pGMAJ3mA1z0pLwG3uIBy5oV7xmaaWkH8BwayS0TrNXskhl1cJ4FiYdBZNzT5aTFQ7_m2oI8hOyryI7V5VE2xyd8S2-XCvD7wj87uPzDcSdKA%3D%3D%22%5D%5D';

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
            'If-Modified-Since' => 'Wed, 07 Feb 2024 21:40:49 GMT',
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

        if (!empty($html)) {

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
            $akaLinks = $crawler->filter('#aka-links h3')->each(function ($akaNode) {
                return $akaNode->text();
            });

            $relativeLinks = $crawler->filter('#relative-links .detail-box-content dl')->each(function ($dlNode) {
                // Initialize an empty array to store merged data
                $mergedData = [];

                // Find all dt and dd pairs within this dl tag
                $dtNodes = $dlNode->filter('dt');
                $ddNodes = $dlNode->filter('dd');

                // Iterate over dt nodes (relative names) and dd nodes (ages)
                $dtNodes->each(function ($dtNode, $i) use ($ddNodes, &$mergedData) {
                    // Get the text content of the dt node (relative name)
                    $relativeName = $dtNode->text();

                    // Get the text content of the corresponding dd node (age)
                    $age = $ddNodes->eq($i)->text();

                    // Merge relative name and age together and add to the merged data array
                    $mergedData[] = [
                        'name' => $relativeName,
                        'age' => $age,
                    ];
                });

                return $mergedData;
            });

            $associates = $crawler->filter('#associate-links .detail-box-content dl')->each(function ($dlNode) {
                // Initialize an empty array to store merged data
                $mergedData = [];

                // Find all dt and dd pairs within this dl tag
                $dtNodes = $dlNode->filter('dt');
                $ddNodes = $dlNode->filter('dd');

                // Iterate over dt nodes (relative names) and dd nodes (ages)
                $dtNodes->each(function ($dtNode, $i) use ($ddNodes, &$mergedData) {
                    // Get the text content of the dt node (relative name)
                    $relativeName = $dtNode->text();

                    // Get the text content of the corresponding dd node (age)
                    $ageString = $ddNodes->eq($i)->text();
                    preg_match('/Age (\d+)/', $ageString, $matches);
                    $age = $matches[1];

                    // Merge relative name and age together and add to the merged data array
                    $mergedData[] = [
                        'name' => $relativeName,
                        'age' => $age,
                    ];
                });

                return $mergedData;
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

            // return response()->json($phoneNumbers);


            // Store person data
            $person = Person::create([
                'fullname' => $fullname[0],
                'age' => $age[0],
                'current_address' => $currentAddress[0],
                'current_employment' => $currentEmployment[0],
                'report' => $report[0]
            ]);

            if ($person) {
                // Store previous addresses
                foreach ($preAddresses as $address) {
                    PreviousAddress::create([
                        'people_id' => $person->id,
                        'address' => $address,
                    ]);
                }

                // Store phone numbers
                foreach ($phoneNumbers as $phoneNumber) {
                    Phone::create([
                        'people_id' => $person->id,
                        'phone_no' => $phoneNumber,
                    ]);
                }

                // Store AKAs
                foreach ($akaLinks as $aka) {
                    Aka::create([
                        'people_id' => $person->id,
                        'name' => $aka,
                    ]);
                }

                // Store relatives
                foreach ($relativeLinks as $relativeEntry) {
                    $relative = $relativeEntry[0];
                    Relative::create([
                        'people_id' => $person->id,
                        'name' => $relative['name'],
                        'age' => $relative['age'],
                    ]);
                }

                // Store associates
                foreach ($associates as $associateEntry) {
                    $associate = $associateEntry[0];
                    Associate::create([
                        'people_id' => $person->id,
                        'name' => $associate['name'],
                        'age' => $associate['age'],
                    ]);
                }

                // Store education data
                foreach ($education as $edu) {
                    Education::create([
                        'people_id' => $person->id,
                        'data' => $edu,
                    ]);
                }

                // Store work experience data
                foreach ($workExp as $work) {
                    Work::create([
                        'people_id' => $person->id,
                        'work_exp' => $work,
                    ]);
                }

                // Store businesses data
                foreach ($businesses as $business) {
                    Business::create([
                        'people_id' => $person->id,
                        'name' => $business,
                    ]);
                }
            }
            return "Success";
        } else {

            return "Error: Empty response received.";
        }
    }




    public function viewData() {
        $persons = Person::all();
        return view('index', compact('persons'));
    }
}
