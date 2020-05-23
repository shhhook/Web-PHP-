<?php

namespace app\models;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "tag".
 *
 * @property int $id
 * @property string|null $title
 *
 * @property ArticleTag[] $articleTags
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
        ];
    }

    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['id' => 'article_id'])->viaTable('article_tag', ['tag_id' => 'id']);
    }

    public static function getArticlesByTag($id, $controller)
    {
        $tag = Tag::findOne($id);

        if ($tag == null) {
            return $controller->actionIndex();
        }

        $query = $tag->hasMany(Article::className(), ['id' => 'article_id'])->viaTable('article_tag', ['tag_id' => 'id']);

        $count = $query->count();

        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 6]);

        $articles = $query->offset($pagination->offset)->limit($pagination->limit)->all();

        $data['articles'] = $articles;
        $data['pagination'] = $pagination;

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * Gets query for [[ArticleTags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticleTags()
    {
        return $this->hasMany(ArticleTag::className(), ['tag_id' => 'id']);
    }
}
