# なに食べ
topic_debug_wsブランチの参照をお願いします。

http://ec2-52-25-104-208.us-west-2.compute.amazonaws.com/
baavgai
baavgai_123

## 開発環境
- Ubuntu 14.04
- PHP 5.5.9
- FuelPHP Version: 1.7.2
- MySQL 5.5.47
- AWS
- Java 1.7.0_95
- Elastic Search

## 技術仕様
### Webアプリケーション
FuelPHPで実装
- お店の管理者登録
- お店の情報編集
- 料理の登録・編集

### 推薦する料理の更新サーバー
iOS側とWebSocket通信しリアルタイムで更新する
iOS側でのyes/noの履歴から以下の更新アルゴリズムをもって更新する
更新はクエリを更新し毎回ElasticSearchで再検索をかけていく
- ratchet

#### 更新アルゴリズム
1. 初期のn枚はフィルタリングしない
2. n枚のyes/no選択の後、categoryのcardinarityをもとにフィルタリングをかけていく
	- name: 商品名（１回のno）
	- cat3: 小カテゴリ（2回のno）
	- cat2: 中カテゴリ（3回のno）
	- cat1: 大カテゴリ（4回のno）
