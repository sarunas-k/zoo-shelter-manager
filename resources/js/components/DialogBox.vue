<template>
    <div class="modal" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Modal title</h5>
              <button type="button" class="close" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        //console.log('Vue: Dialog Component mounted.');
    },
    data: function() {
        return {

        }
    },
    props: {
      title: {
        required: true,
        type: String,
        default: ''
      },
      type: {
        required: true,
        type: String,
        default: ''
      }
    }
}
</script>

<style scoped>
.modal {
  display: block;
}
</style>