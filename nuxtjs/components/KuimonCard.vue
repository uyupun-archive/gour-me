<template>
  <div>
    <div class="modal d-block">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">結果</h4>
            <button type="button" @click="closeModal" class="close"><span>&times;</span></button>
          </div>
          <div class="modal-body">
            <div v-for="food in foods">
              <h2>名前:<span>{{food.name}}</span></h2>
              <h2>都道府県:<span>{{food.prefecture}}</span></h2>
              <h2>特徴:<span>{{food.description}}</span></h2>
              <h2>こってり度:<span>{{food.kotteri_level}}</span></h2>
              <h2>がっつり度:<span>{{food.gatturi_level}}</span></h2>
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
