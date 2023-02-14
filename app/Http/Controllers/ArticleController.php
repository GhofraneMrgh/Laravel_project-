<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Import;
use Carbon\Carbon;


class ArticleController extends Controller
{
    public function import(Request $request)
{
    $siteRssUrl = $request->input('siteRssUrl');

    // Connect to the RSS feed URL and download the file
    $rss = file_get_contents($siteRssUrl);

    // Save the raw content in the imports table
    $import = new Import;
    $import->importDate = Carbon::now();
    $import->rawContent = $rss;
    $import->save();

    // Parse the XML
     $xml = simplexml_load_string($rss);
    foreach ($xml->channel->item as $item) {
        $externalId = $item->guid;

        // Check if the article already exists in the database
        $article = Article::firstOrNew(['externalId' => $externalId]);

        // Update the article data
        $article->title = $item->title;
        $article->description = $item->description;
        $article->publicationDate = Carbon::parse($item->pubDate);
        $article->link = $item->link;
        $article->mainPicture = $item->enclosure['url'] ?? '';

        // Save the article
        $article->save();
    }
       
        return response()->json(['message' => 'Articles imported successfully']);
}

public function index()
{
    $articles = Article::all();
    $vowels = ['a', 'e', 'i', 'o', 'u'];

    foreach ($articles as $article) {
        $titleWords = explode(' ', $article->title);
        $maxVowelWord = '';
        $maxVowelCount = 0;

        foreach ($titleWords as $word) {
            $vowelCount = 0;

            for ($i = 0; $i < strlen($word); $i++) {
                if (in_array(strtolower($word[$i]), $vowels)) {
                    $vowelCount++;
                }
            }

            if ($vowelCount > $maxVowelCount) {
                $maxVowelCount = $vowelCount;
                $maxVowelWord = $word;
            }
        }

        $article->maxVowelWord = $maxVowelWord;
    }

    return response()->json($articles);
}



}
