<template>
<form @submit="addMeet">
    <div class="form-group">
        <label for="title" class="form-label">Meeting Title</label>
        <input placeholder="Meeting Title" type="text" name="title" id="title" class="form-control" required v-model="meetItem.title"> 
    </div>
     <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="isRepeat" name="isRepeat" v-on:click="meetItem.schedule.isRepeat = !meetItem.schedule.isRepeat">
        <label class="form-check-label" for="isRepeat">Repeating meeting?</label>
    </div>
    <div class="form-group">
        <label for="start" class="form-label">Meeting Start Time</label>
        <input type="datetime-local" name="start" id="start" class="form-control" required v-model="meetItem.schedule.start" >
    </div>
    <div class="form-group">
        <label for="duration" class="form-label">Meeting Duration (Minutes)</label>
        <input type="number" name="duration" id="duration" class="form-control" required min="1" placeholder="Minutes" v-model="meetItem.schedule.duration">
    </div>
    <div v-if="meetItem.schedule.isRepeat" class="form-group">
        <label for="repDays" class="form-label">Repeating Duration (Days)</label>
        <input type="number" name="repDays" id="repDays" class="form-control" min="1" placeholder="Days" v-model="meetItem.schedule.repDays">
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
export default {
    mounted() {
        console.log('Meeting Form Component mounted.')
    },
    data: function() {
        return {
            err: null,
            meetItem: {
                title: '',
                schedule: {
                    isRepeat: false,
                    start: '',
                    duration: '',
                    repDays: '',
                }
            }
        }
        
    },
    methods: {
        addMeet() {
            // Actual posting information
            axios.post('/meetings', this.meetItem)
            .then(response => {
                if(response.err != ""){
                    alert(response.data.err)
                } else {
                    alert('Meeting Added...')
                }
            });
        },
    }
}
</script>