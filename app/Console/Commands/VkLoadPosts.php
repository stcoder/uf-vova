<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\Message\Request;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class VkLoadPosts extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'vk:load_posts';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Загружает посты из группы ВК.';

	/**
	 * Идентификатор группы Vk.
	 *
	 * @var string
	 */
	protected $ownerId = null;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$this->getPosts();
	}

	public function getPosts($offset = 1, $count = 10)
	{
		$this->ownerId = '4763311';
		$res = $this->load($offset, $count);
		$this->isError($res);

		$countPosts = $res->response[0];
		$posts = array_splice($res->response, 1);

		foreach($posts as $post) {
			$attachments = $this->prepareAttachments($post);
		}
	}

	public function prepareAttachments($post)
	{
		if (!isset($post->attachments)) {
			return null;
		}

		$result = [];
		$attachments = $post->attachments;
		foreach($attachments as $attachment) {
			$type = $attachment->type;

			if ($type === 'video') {
                $r = $this->loadVideo($this->makeVideoId($attachment->video->owner_id, $attachment->video->vid));
                var_dump($r);
			}
		}

		return $result;
	}

	/**
	 * Проверяет ответ на ошибки.
	 * 
	 * @param  object $response
	 * @throws \Exception
	 * @return boolean
	 */
	public function isError($response)
	{
		if (!is_object($response)) {
			throw new \Exception("Incorrect response type");
		}

		if (isset($response->error)) {
			throw new \Exception($response->error->error_msg, $response->error->error_code);
		}

		return false;
	}

	/**
	 * Декодирует ответ в объект.
	 * 
	 * @param \GuzzleHttp\Message\ResponseInterface $raw_response
	 * @return object
	 */
	public function prepareResponse($raw_response = '')
	{
		$response = (string) $raw_response->getBody();
		return json_decode($response);
	}

	/**
	 * Загружает посты из группы и возвращает объект с результатами.
	 * 
	 * @param  integer $offset
	 * @param  integer $count
	 * @return object
	 */
	public function load($offset = 1, $count = 10)
	{
		return $this->request($this->getUrl($offset, $count));
	}

	public function loadVideo($videoId)
    {
        return $this->request($this->getUrlVideo($videoId));
    }

    /**
     * @param int|string $video_id
     * @param int|string $owner_id
     * @return string
     */
    public function makeVideoId($video_id, $owner_id)
    {
        return implode('_', [$video_id, $owner_id]);
    }

	/**
	 * @param  string $url
	 * @return object
	 */
	public function request($url)
	{
		$client = new Client();
		$request = new Request('GET', $url);
		$response = $client->send($request);

		return $this->prepareResponse($response);
	}

	/**
	 * Возвращает URL строку для получения постов.
	 *
	 * @param int $offset
	 * @param int $count
	 * @return string
	 */
	public function getUrl($offset = 1, $count = 10)
	{
		return "https://api.vk.com/method/wall.get?owner_id=-{$this->ownerId}&filter=all&count={$count}&offset={$offset}";
	}

    /**
     * Возвращает URL строку для получения видео.
     *
     * @param string $videoId
     * @return string
     */
    public function getUrlVideo($videoId)
    {
        return "https://api.vk.com/method/video.get?videos={$videoId}&count=1";
    }

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
		];
	}

}
