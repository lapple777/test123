<?php
namespace app\index\controller;

class Push{
    /**
     * @var string 目标用户id
     */
    protected $to_user = '';

    /**
     * @var string 推送服务地址
     */
    protected $push_api_url = 'http://127.0.0.1:2121/';

    /**
     * @var string 推送内容
     */
    protected $content = '';

    /**
     * 设置推送用户，若参数留空则推送到所有在线用户
     *
     * @param string $user
     * @return $this
     */
    public function setUser($user = '')
    {
        $this->to_user = $user ? : '';
        return $this;
    }

    /**
     * 设置推送内容
     *
     * @param string $content
     * @return $this
     */
    public function setContent($content = '')
    {
        $this->content = $content;
        return $this;
    }

    /**
     * 推送
     */
    public function push()
    {
        $data = [
            'type' => 'publish',
            'content' => $this->content,
            'to' => $this->to_user,
        ];
        $url = $this->push_api_url;
        $postUrl = $url;
        $curlPost = $data;
        $ch = curl_init();//初始化curl
        curl_setopt($ch, CURLOPT_URL,$postUrl);//抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $data = curl_exec($ch);//运行curl
        curl_close($ch);
        return $data;

    }

}