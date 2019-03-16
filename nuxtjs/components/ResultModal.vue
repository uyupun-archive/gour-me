<template>
  <div>
    <div class="modal d-block">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-body text-center border-0">
            <p>今のあなたの気分に合った料理は ...</p>
            <h2 class="h2">{{food.name}}<span class="small-text ml-2">です！</span></h2>
            <h5 class="h5 mb-5">
              <span>こってり度: {{food.kotteri_level}}ｺｯﾃﾘ</span> /
              <span>がっつり度: {{food.gatturi_level}}ｶﾞｯﾂﾘ</span>
            </h5>
            <p>都道府県: {{food.locate}}</p>
            <p>解説: {{food.description}}</p>
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
    food: {
      type: Object,
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
  .small-text {
    font-size: 16px;
  }
</style>
