<template>
<form @submit="addMeet" >
    <div class="form-group">
        <label for="title" class="form-label">Meeting Title</label>
        <input placeholder="Meeting Title" type="text" name="title" id="title" class="form-control" v-model="meetItem.title"> 
    </div>
    <div class="form-group">
        <label for="start" class="form-label">Meeting Start Time</label>
        <input type="datetime-local" name="start" id="start" class="form-control" v-model="meetItem.start" >
    </div>
    <div class="form-group">
        <label for="duration" class="form-label">Meeting Duration (Each 0.1 step is about 6 Minutes)</label>
        <input type="number" name="end" id="end" class="form-control" min="1" placeholder="Hours" step="0.1" max="9" v-model="meetItem.duration">
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
            // Actual posting information
            axios
            .post('/meetings', this.meetItem)
            .then(response => {
                alert('Meeting Added...')
                // this.fetchMeetingList()
            })
            .catch(err => {
                console.log(err)
            })
        },
    }
}
</script>