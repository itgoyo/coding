<?php
/** .-------------------------------------------------------------------
 * |  Software: [HDPHP framework]
 * |      Site: www.hdphp.com  www.hdcms.com
 * |-------------------------------------------------------------------
 * |    Author: 向军 <2300071698@qq.com>
 * |    WeChat: aihoudun
 * | Copyright (c) 2012-2019, www.houdunwang.com. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace Houdunwang\WeChat\Build\Material;

use houdunwang\curl\Curl;
use GuzzleHttp\Client;

/**
 * 永久素材
 * Trait LongMaterial
 *
 * @package Houdunwang\WeChat\material
 */
trait Matter
{
    /**
     * 上传永久素材
     *
     * @param string $type 素材类型
     * @param string $file 文件资源
     *
     * @return array|mixed
     */
    public function addMaterial($type, $file)
    {
        $url = $this->apiUrl . "/cgi-bin/material/add_material?access_token={$this->accessToken}&type=$type";
        return $this->get(Curl::post($url, $this->getPostMedia($file)));
    }

    /**
     * 上传永久视频素材
     * @param string $file 素材文件
     * @param array $description 描述信息
     * @return mixed
     */
    public function addVideoMaterial(string $file, array $description)
    {
        $url = $this->apiUrl
            . "/cgi-bin/material/add_material?access_token={$this->accessToken}&type=video";
        $post = $this->getPostMedia($file);
        $post['description'] = json_encode($description, JSON_UNESCAPED_UNICODE);
        $client = (new Client())->request('POST',$url,$post);
        return $this->get($client);
    }

    /**
     * 获取永久素材
     * @param string $mediaId 素材编号
     * @return mixed
     */
    public function getMaterial(string $mediaId)
    {
        $url = $this->apiUrl
            . "/cgi-bin/material/get_material?access_token={$this->accessToken}";
        $json = '{"media_id":"' . $mediaId . '"}';
        return $this->get(Curl::post($url, $json));
    }

    /**删除永久素材
     *
     * @param string $media_id 素材编号
     * @return mixed
     */
    public function delMaterial(string $media_id)
    {
        $url = $this->apiUrl
            . "/cgi-bin/material/del_material?access_token={$this->accessToken}";
        $json = '{"media_id":"' . $media_id . '"}';

        return $this->get(Curl::post($url, $json));
    }
}
