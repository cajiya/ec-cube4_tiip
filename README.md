# EC-CUBE4.1用 商品の人気雰囲気演出機能

商品ページに、
- この商品を X人がカートに追加しています
- この商品を X人がお気に入りに登録しています
といった表現を追加するプラグインです。
    
## 仕様

### カートに追加されている件数
過去30日以内に更新のあったカート内から、同一の商品コードが何件存在するかを取得しています。

### お気に入りに登録されている件数
全期間内から、お気に入りに登録されている件数を表示させています。

## イメージ

# インストール方法

```
cd app/Plugin;
git clone https://github.com/cajiya/ec-cube4_tiip.git;
mv ec-cube4_tiip TheItemIsPopular;
cd ../../;
php bin/console eccube:plugin:install --code="TheItemIsPopular"
```

