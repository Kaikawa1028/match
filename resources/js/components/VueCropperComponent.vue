<template>
  <div>
    <input type="file" v-on:change="onFileChange()" class="mb-3">
    <input type="hidden" :value="imgData" name="img_data">
    <div class="content">
        <div class="vue-cropper-wrap" v-if="srcImg != ''">
            <vue-cropper
            ref="cropper"
            :guides="true"
            :view-mode="2"
            :src="srcImg"
            :background='true'
            drag-mode="crop"
            :auto-crop-area="1"
            :aspect-ratio="1"
            :img-style="{'width': '320px', 'height':'320px'}"
            ></vue-cropper>
        </div>
        <div v-if="srcImg != ''">
            <button type="button" class="btn btn-success" @click="cropImage">トリミングする。</button>
        </div>
    </div>
  </div>
</template>

<script>
import VueCropper from "vue-cropperjs";
import "cropperjs/dist/cropper.css";
export default {
  components: {
    VueCropper
  },
  data() {
    return {
      uploadFile:"",
      cropImg: "",
      srcImg:"",
      imgData: "",
    };
  },
  methods: {
    onFileChange() {
      var file = event.target.files[0];
      if (!/\.(gif|jpg|jpeg|png|bmp|GIF|JPG|PNG)$/.test(event.target.value)) {
        alert(".gif,jpeg,jpg,png,bmpファイルしかアップロードできません。");
        return false;
      }
      var reader = new FileReader();
      reader.onload = e => {
        let data;
        if (typeof e.target.result === "object") {
          data = window.URL.createObjectURL(new Blob([e.target.result]));
        } else {
          data = e.target.result;
        }
        this.srcImg = data;
        this.uploadFile = data;
        this.$refs.cropper.replace(data);
      };
      reader.readAsArrayBuffer(file);
    },
    cropImage() {
        let data = this.$refs.cropper.getCroppedCanvas().toDataURL();
        this.$refs.cropper.replace(data);
        this.imgData = data;
    }
  }
};
</script>

<<style>
  * {
    margin: 0;
    padding: 0;
  }

  .content {
    margin: auto;
    max-width: 1200px;
  }

  .show-info h2 {
    line-height: 50px;
  }

  .vue-cropper-wrap {
    height: 340px;
  }
</style>
