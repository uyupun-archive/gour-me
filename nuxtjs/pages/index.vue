<template>
  <div>
    <div class="container">
      <h1 class="text-center">gour.me</h1>
      <p class="text-center">あなたに合ったグルメをレコメンドします.</p>
      <div class="graph-area">
        <div class="graph-label-top">がっつり</div>
        <div class="graph" @click="getCoordinate" />
        <div class="graph-label-right">こってり</div>
      </div>
      <result-modal v-if="openModal" :food="food"/>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import ResultModal from '~/components/ResultModal'

export default {
  components: {
    ResultModal,
  },
  data() {
    return {
      recommend: {},
      display: false,
    }
  },
  computed: {
    // モーダルを開く
    openModal() {
      if (this.display) return this.display;
    },
    food() {
      if (this.recommend) return this.recommend;
    }
  },
  methods: {
    // 座標データを渡してレコメンドを受け取る
    async fetchRecommendData(kotteriLevel, gatturiLevel) {
      const { data } = await axios.get('/api/recommend', {
        params: {
          kotteriLevel: kotteriLevel,
          gatturiLevel: gatturiLevel,
        }
      });
      this.recommend = data;
    },
    // 座標の取得
    getCoordinate(e) {
      let rect = e.target.getBoundingClientRect()
      let x = e.clientX - rect.left
      let y = e.clientY - rect.top
      let maxX = rect.width
      let maxY = rect.height
      let kotterLevel = Math.round(x / maxX * 100)
      let gatturiLevel = Math.round(100 - y / maxY * 100)
      this.fetchRecommendData(kotterLevel, gatturiLevel)
      this.display = true
    }
  }
}
</script>

<style lang="scss" scoped>
  .container {
    max-width: 800px;
    margin: 0 auto;
    padding: 0 30px;
  }
  .graph {
    position: relative;
    left: 50%;
    transform: translateX(-50%);
    width: calc(100vmin - 150px);
    height: calc(100vmin - 150px);
    cursor: pointer;
    &:before {
      position: absolute;
      content: "";
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 95%;
      height: 2px;
      background: #777;
    }
    &:after {
      position: absolute;
      content: "";
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 2px;
      height: 95%;
      background: #777;
    }
    &-area {
      position: relative;
      border: #ccc solid 3px;
      border-radius: 5px;
    }
    &-label {
      &-top {
        text-align: center;
      }
      &-right {
        position: absolute;
        top: 50%;
        right: 5%;
        transform: translateY(-25%);
        writing-mode: vertical-rl;
      }
    }
  }
</style>
