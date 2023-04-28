## ■サービス概要
### 「実質無料」自慢
[![Image from Gyazo](https://i.gyazo.com/577820f39d978903d8c495119018a6be.png)](https://gyazo.com/577820f39d978903d8c495119018a6be)
### ▼サービスURL
https://waste-crud.herokuapp.com/

## ■概要
お金では計れない思い出を共有しようというアプリです。  
そもそも「実質無料」とは、アイドルなどのヲタクが通常の金銭感覚とは異なるお金の使い方をした時、それでも価値がある！と表明する言葉です。  
ヲタクの方以外でも、贅沢をして多幸感を感じた経験を自慢し合おうというアプリです。  

## ■メインターゲットユーザー
- SNSを使用する10~30代

## ■ユーザーが抱える課題
- 趣味にお金を使いすぎた投稿をする際、自分の金銭的価値観に合わない人の目が気になる。
- 贅沢なお金の使い方をした時、詳しく記録したいがマウントは取りたくないため記録しきれない。
- Twitterなどに自虐として無駄使い経験を投稿したいが、自虐風自慢に思われたくないため辞めてしまう。

## ■解決方法
- 贅沢なことを自慢することに特化することで、他人の目を気にせず記録できる環境を提供する。
- 金額や思い出をカラムに持つ投稿にし、詳しく贅沢なことをした経験を投稿できるようにする。

## ■使用技術
 - バックエンド  
 PHP(8.2.5), Laravel(10.8.0)
 - フロントエンド  
 Tailwind css
 - 開発環境  
 Laravel sail
 - インフラ  
 Heroku
 MySQL(ClearDB)
 S3（画像アップロード先）

## ■実装機能
 - ユーザー登録機能
 - ログイン・ログアウト機能（認証機能）
 - 投稿のCRUD機能
 - 金額(投稿内容)の検索機能(最低金額を指定し、その金額以上の投稿検索)
 - 自分の投稿一覧表示
 - プロフィール編集

## ■ER図

