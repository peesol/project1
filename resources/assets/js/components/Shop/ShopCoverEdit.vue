<template>
<div class="padding-15-vertical" id="full-line">
  <label class="full-label heading">{{$trans.translation.cover}}&nbsp;<span class="font-small">1100px * 315px</span></label>
  <form v-on:submit.prevent="edit" method="post">

    <div class="cover-input margin-10-top">
      <span class="fas fa-images"></span>
      <img :src="cover">
    </div>
    <div class="flex flex-between padding-15-top">
      <label class="file-input shadow-1">
        <input @change="previewCover" id="cover-input" type="file" :name="cover" accept="image/*"/>
        {{$trans.translation.choose_file}}&nbsp;+
      </label>
      <button class="file-input shadow-1" v-if="cover !== null" @click.prevent="removeCover">{{$trans.translation.remove}}</button>
    </div>

    <div class="align-right padding-15-top">
      <button :disabled="$root.loading" type="submit" class="orange-btn normal-sq">{{$trans.translation.edit_submit}}</button>
    </div>
  </form>
</div>
</template>

<script>
export default {
  data() {
    return {
      cover: this.$parent.shopCover,
    }
  },
  methods: {
    edit() {
      if (document.getElementById("cover-input").files.length == 0) {
        toastr.info(this.$trans.translation.dropzone_null);
      }

      if (document.getElementById("cover-input").files.length > 0) {
        this.$Progress.start();
        this.$root.loading = true
        toastr.info(this.$trans.translation.wait);
        this.$http.put(this.$root.url + '/' + this.$parent.shopSlug + '/edit/cover', {
          cover: this.cover,
        }).then(response => {
          this.$Progress.finish();
          this.$root.loading = false
          toastr.success(this.$trans.translation.success);
        }, response => {
          this.$Progress.fail();
          this.$root.loading = false
          toastr.error(this.$trans.translation.error);
        });
      }
    },
    previewCover(event) {
      var input = event.target;
      if (input.files && input.files[0]) {
        if (input.files[0].size > 1048576) {
          alert(this.$trans.translation.file_size_limit + ' 1 MB');
          this.removefile()
        }
        var reader = new FileReader();
        var vm = this;
        reader.onload = function(e) {
          vm.cover = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
      }
    },
    removeCover() {
      this.cover = null;
    },
  }
}
</script>
