<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" >
                <ul>
                    <meet-item v-for="meet in meetingList" :meet="meet" :key="meet.id"></meet-item>                
                </ul>
            </div>
        </div>
    </div>
</template> 
<script>
import meetItem from "./MeetingComponent"
export default {
    mounted() { // Standard mounting
        console.log('Meeting List Component mounted.')
    },
    components: {
        meetItem
    },
    data: function() { // Grab the initial Data
        return {
            meetingList : [
                // {
                //     title: "Event 1",
                //     start: new Date().toLocaleString(),
                //     duration: 1
                // },
                // {
                //     title: "Event 2",
                //     start: new Date().toLocaleString(),
                //     duration: 1
                // },
                // {
                //     title: "Event 3",
                //     start: new Date().toLocaleString(),
                //     duration: 1
                // },
                // {
                //     title: "Event Negative",
                //     start: new Date().toLocaleString(),
                //     duration: 1
                // },
            ],

        }
    },
    created() {
       this.fetchMeetingList()
    },
    methods: {
        fetchMeetingList: function(){
            axios.get('/meetings')
            .then((result) => {
                // console.log(result)
                this.meetingList = result.data
            })
            // .catch(err => {
            //     console.log(err)
            // })
        }
    },
    // ready: function(){
    //     this.fetchMeetingList();
}
</script>