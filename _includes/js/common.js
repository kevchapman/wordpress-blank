core = {
	readyEvents: new EventStack(),
	loadEvents: new EventStack()
};
core.readyEvents.add(function(){
	// add ready event here
	core.resizer = new Resizer();
});
$(function(){
	core.readyEvents.run();
})
