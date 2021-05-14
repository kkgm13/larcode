<template>
<form @submit.prevent="addMeet" >
    <div class="form-group">
        <label for="title" class="form-label">Meeting Title</label>
        <input placeholder="Meeting Title" type="text" name="title" id="title" class="form-control" v-model="meetItem.title"> 
    </div>
    <div class="form-group">
        <label for="start" class="form-label">Meeting Start Time</label>
        <input type="datetime-local" name="start" id="start" class="form-control" v-model="meetItem.start" >
    </div>
    <div class="form-group">
        <label for="duration" class="form-label">Meeting Duration</label>
        <input type="number" name="end" id="end" class="form-control" min="1" placeholder="Hours" max="9" v-model="meetItem.duration">
    </div>
    <hr>
    <div class="row form-group">
        <div class="col-md-6 col-sm-12 py-1">
            <input type="submit" value="Create Meeting" class="btn btn-success btn-block">
        </div>
        <div class="col-md-6 col-sm-12 py-1">
            <input type="reset" value="Reset" class="btn btn-danger btn-block">
        </div>
    </div>
</form>
  
</template>
<script>
var today = new Date();
export default {
    mounted() {
        console.log('Meeting Form Component mounted.')
    },
    data: function() {
        return {
            meetItem: {
                title: '',
                duration: '',
                start: '',
            }
        }
        
    },
    methods: {
        addMeet() {
            // Check for errors
            this.err = {}
            // Actual posting information
            console.log(this.meetItem)
            axios
            .post('/meetings', this.meetItem)
            .then(response => {
                alert('Meeting Added...')
            })
            .catch(err => {
                console.log(err)
            })
            .finally(()=> this.loading = false)
        },
    }
}
</script>