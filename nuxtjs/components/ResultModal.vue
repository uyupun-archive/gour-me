<template>
  <div>
    <div class="modal d-block">
      <div class="modal-dialog modal-dialog-centered modal-lg">

        <div v-if="!isShowShopInfo" class="modal-content">
          <div class="modal-body text-center border-0">
            <p>今のあなたの気分に合った料理は ...</p>
            <h2 class="h2 mb-4">{{ recommend.name }}<span class="small-text ml-2">です！</span></h2>
            <h5 class="h5 mb-5">
              <span>こってり度: {{ recommend.kotteri_level }}ｺｯﾃﾘ</span> /
              <span>がっつり度: {{ recommend.gatturi_level }}ｶﾞｯﾂﾘ</span>
            </h5>
            <p>都道府県: {{ recommend.locate }}</p>
            <p>解説: {{ recommend.description }}</p>
            <p class="text-danger">{{ shopMessage }}</p>
          </div>
          <div class="modal-footer border-0">
            <button type="button" @click="searchShopInfo" class="btn btn-primary">近くの店舗を探す</button>
            <button type="button" @click="closeModal" class="btn btn-danger">閉じる</button>
          </div>
        </div>

        <div v-if="isShowShopInfo" class="modal-content">
          <div class="modal-body border-0">
            <h2 class="h2 text-center mb-4">{{ recommend.name }}<span class="small-text ml-2">のお店</span></h2>
            <div v-for="shop in shops" class="mb-3">
              <div v-if="shop.name">店名: {{ shop.name }}</div>
              <div v-if="shop.address">
                住所: <a :href="getGoogleMapLinks(shop.address)" target="_blank">{{ shop.address }}</a>
              </div>
              <div v-if="shop.tel">電話番号:{{ shop.tel }}</div>
            </div>
          </div>
          <div class="modal-footer border-0">
            <button type="button" @click="closeModal" class="btn btn-danger">閉じる</button>
          </div>
        </div>

      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    recommend: {
      type: Object,
      default: [],
    },
    display: {
      type: Boolean,
      default: true,
    }
  },
  data() {
    return {
      isShowShopInfo: false,
      shops: [],
      shopMessage: '',
      latitude: null,
      longitude: null,
    }
  },
  methods: {
    // モーダルを閉じる
    closeModal() {
      this.show = false;
      this.shopMessage = '';
      this.$parent.display = false;
    },
    // ぐるなびAPIからキーワードに合った店舗情報をとってくる
    async searchShopInfo() {
      try {
        const { data } = await this.$axios.get('https://api.gnavi.co.jp/RestSearchAPI/v3/', {
          params: {
            keyid: process.env.FRONT_GURUNABI_API_KEY,
            freeword: this.recommend.name,
            area: 'AREA120' // 関西のエリアID
          }
        });
        this.shops = data.rest;
        this.isShowShopInfo = true;
      } catch (e) {
        this.shopMessage = 'オススメできる店舗を見つけられませんでした.';
        this.isShowShopInfo = false;
      }
    },
    // GoogleMapのリンクを取得する
    getGoogleMapLinks(address) {
      const baseUrl = 'http://maps.google.co.jp/maps';
      const fmtAddress = address.substr(10);
      return `${baseUrl}?q=` + encodeURI(fmtAddress);
    }
  }
}
</script>

<style lang="scss" scoped>
  .modal {
    background: rgba(0, 0, 0, 0.5);
    overflow-y: initial !important;
    &-content {
      opacity: 0;
      overflow-y: initial !important;
      animation: .4s .15s 1 linear forwards speed;
    }
    &-body {
      overflow-y:auto;
    }
  }
  @keyframes speed {
    from {
      opacity: 0;
    }
    to {
      opacity: 1;
    }
  }
  .small-text {
    font-size: 16px;
  }
</style>
