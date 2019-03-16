<template>
  <div>
    <div class="modal d-block">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <p class="modal-title">今のあなたの気分に合った料理は ...</p>
          </div>
          <div class="modal-body">
            <div v-for="food in foods">
              <h2 class="text-center h2">{{food.name}}です！</h2>
              <h5 class="text-center h5 mb-5">
                <span>こってり度: {{food.kotteri_level}}ｺｯﾃﾘ</span> /
                <span>がっつり度: {{food.gatturi_level}}ｶﾞｯﾂﾘ</span>
              </h5>
              <p class="text-center">都道府県: {{food.prefecture}}</p>
              <p class="text-center">解説: {{food.description}}</p>
            </div>
          </div>
          <div class="modal-footer">
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
    foods: {
      type: Array,
      default: []
    },
    display: {
      type: Boolean,
      default: true
    }
  },
  methods: {
    // モーダルを閉じる
    closeModal() {
      this.$parent.display = false
    }
  }
}
</script>

<style lang="scss" scoped>
  .modal {
    background: rgba(0,0,0,0.5);
    &-content {
      opacity: 0;
      animation: .5s 1 linear forwards speed;
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
</style>
