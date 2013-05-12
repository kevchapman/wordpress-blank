// Classes ----------------- 
function EventStack(){
	this.events = [];
}
EventStack.prototype = {
	add:function(f){
		this.events.push(f);
	},
	run:function(){
		var l = this.events.length, i;
		for(i=0; i<l; i++){
			this.events[i]();
		}
	}
}
function Resizer(opts){
	this.b = $('body');
	this.w = this.b.width();
	this.functions = [];
	this.win = $(window);
	this.h = this.win.height();
	(function(t){ t.init(); })(this);
}
Resizer.prototype = {
	init:function(){
		var t = this;
		this.win.on('resize.resizer',function(){
			var w = t.b.width(), h = t.win.height();
			if(w !== t.w || h !== t.h){
				t.run(w);
				t.w = w;
				t.h = h;
			}
		})
	},
	add:function(f){
		this.functions.push(f);
	},
	run:function(w){
		var t = this;
		t.timer ? clearTimeout(t.timer) : '';
		t.timer = setTimeout(function(){ 
			var i, l = t.functions.length;
			for(i=0; i<l; i++){ t.functions[i](); }
		},300);
	}
}
function Slider(ele,opts){
	if(!ele.length){return}
	var defaults = {
		next: 'a.next',
		prev: 'a.prev',
		paging: 'div.slider_paging',
		scroll: 'div.slider_scroll',
		mask: 'div.slider_mask',
		items:'div.slider_item',
		touch:true,
		speed: 200,
		offset:0,
		autoInit:true,
		row:1,
		extend_layout:false,
		callback:false,
		css3:true,
		resizeItems:true,
		startItem:0
	}
	var o = $.extend({},defaults,opts);
	this.opts = o;
	this.index = 0;
	this.ele = ele;
	this.mask = this.ele.find(o.mask);
	this.scroller = this.ele.find(o.scroll);
	this.items = this.scroller.find(o.items);
	this.btn_next = this.ele.find(o.next);
	this.btn_prev = this.ele.find(o.prev);
	this.pagingNav = this.ele.find(o.paging);
	this.x = 0;
	this.y = 0;
	this.css3 = o.touch && o.css3 && 'webkitTransform' in this.ele[0].style;
	
	if(o.autoInit){ this.init(); }
	return this;
}
Slider.prototype = {
	init:function(){
		var t = this;
		// bind btns
		this.btn_next.click(function(){
			t.stop();
			t.next();
			return false;
		});
		this.btn_prev.click(function(){
			t.stop();
			t.prev();
			return false;
		});
		// set auto timer 
		if(this.opts.auto){
			this.timer = setInterval(function(){ t.next(); }, this.opts.auto);
		}
		this.layout();
		if(this.pagingNav){ this.initPaging(); }
		// set disabled classes on btns and paging
		this.setBtnStatus();
		if(this.opts.touch){
			this.bindTouch();
		}
		this.goTo(this.opts.startItem);
		return this;
	},
	layout:function(){
		var t = this, mw = t.mask.width(), margin = (t.opts.row-1)*(t.offset*2);
		var w = t.opts.row > 1 ? (mw - m) / t.opts.row : mw;
		this.maskW = mw;
		this.items = this.scroller.find(this.opts.items);
		this.items.css({float:'left',marginLeft:t.offset,marginRight:t.offset});
		if(this.opts.resizeItems){ this.items.width(w); }
		this.totalW = (function(t){
			var w = 0;
			t.items.each(function(){
				w = w+$(this).outerWidth(true);
			});
			return w;
		})(this);
		this.itemW = t.items.outerWidth(true) * t.opts.row;
		this.total = t.items.length / t.opts.row;
		this.scroller
			.width(t.total * t.itemW )
			.css({marginLeft:-t.offset});	
		this.parent && !t.pagingNav ? t.parent.setHeight() : '';
		if(this.opts.extend_layout){ this.opts.extend_layout(); };
	},
	getIndex:function (){
		if( this.index <=0 ){ this.index = 0 }
		else if(this.index > this.total - 1 ) { this.opts.auto ? this.index = 0 : this.index = this.total-1 }
		return this.index;
	},
	bindTouch:function(){
		var t = this;
		this.scroller[0].ontouchstart = function(e){
			t.opts.auto ? t.stop() : '';
			if (e.targetTouches.length != 1) {return false;}
			t.scroller[0].style.webkitTransition = '';
			t.startX = e.targetTouches[0].clientX;
			t.cTouch = t.startX;
			t.startY = e.targetTouches[0].clientY;
			t.getPosition(t.scroller[0].style.webkitTransform);
		}
		this.scroller[0].ontouchmove = function(e){
			if (e.targetTouches.length != 1) { return false; }
			var leftDelta = e.targetTouches[0].clientX - t.startX;
			var topDelta = e.targetTouches[0].clientY - t.startY;
			t.move(leftDelta,0);
			t.cTouch = e.targetTouches[0].clientX;
		}
		this.scroller[0].ontouchend = function(e){
			var difX = t.startX - t.cTouch, limit = t.mask.width()*0.1;
			e.preventDefault();
			if (e.targetTouches.length > 0) { return false; }
			if(difX > limit){ t.next();}
			else if( difX < -limit ){ t.prev();}
			else {t.goTo(t.getIndex());}
		}
	},
	next:function(){
		this.index++;
		this.goTo(this.getIndex());
	},
	prev:function(){
		this.index--;
		this.goTo(this.getIndex());
	},
	stop:function(){ if(this.opts.auto) { clearInterval(this.timer); this.opts.auto = false; }; },
	aMove:function(n,x){
		var
			t = this,
			move = (x || x === 0 ? x : this.itemW * n)
			max = (move+this.maskW);
		if( max > this.totalW){
			move = this.totalW - this.mask.width();
		}
		if(this.css3){
			this.scroller[0].style.webkitTransition = '-webkit-transform '+this.opts.speed+'ms ease';
			this.scroller[0].style.webkitTransform = 'translate3d(-'+move+'px,0,0)';
			this.scroller.one('webkitTransitionEnd',function(){
				t.getPosition(this.style.webkitTransform);
				this.style.webkitTransition = '';
				transitionEnd();
			});
			return;
		}
		this.scroller.animate({left:-move},this.opts.speed,function(){
			transitionEnd();
		});

		function transitionEnd(){
			t.index = n;
			if(t.opts.callback){ t.opts.callback(t);}
			t.setActive();
		}
	},
	move:function(x,y){
		var newX = parseInt(this.x+x);
		this.scroller[0].style.webkitTransform = 'translate3d('+newX+'px,0,0)';
	},
	goTo:function(n){
		this.index = parseInt(n);
		this.aMove(n);
		this.setBtnStatus();
	},
	initPaging: function(){
		var pi = '<ul class="sliderPaging">',t=this;
		if(this.total > 1){
			for(var i=0; i<this.total; i++){ pi+='<li><a href="#"><span>'+parseInt(i)+'</span></a></li>';}
			this.pagingNav.html(pi+'</ul>');
			this.pagingLinks = this.pagingNav.find('a');
			this.pagingLinks.click(function(){ t.stop();t.goTo( $(this).find('span').text() ); return false; })
			this.setActive();
		}
		t.parent ? t.parent.setHeight() : '';
	},
	setActive: function(){
		var pl = this.pagingLinks || [];
		if(pl.length){ 
			pl.filter('.active').removeClass('active');
			$(pl[this.index]).addClass('active');
		}
	},
	setBtnStatus:function(){
		if( this.index == 0 ){ this.btn_prev.addClass('disabled');this.btn_next.removeClass('disabled'); if(this.total == 1){this.btn_next.addClass('disabled')} }
		else if(this.index >= this.total -1 ){ this.btn_next.addClass('disabled');this.btn_prev.removeClass('disabled'); }
		else { this.btn_prev.add(this.btn_next).removeClass('disabled'); }
	},
	getPosition:function(transform){
		var v = transform.replace(/[a-z]/g,'').replace('3(','').replace(')','').split(',') || [0,0,0];
		this.x = parseInt(v[0]);
		this.y = parseInt(v[1]);
	},
	reSize: function(sliderIndex){
		var n = sliderIndex || this.getIndex();
		this.items = this.scroller.find(this.itemsSelect);
		this.total = Math.ceil(this.items.length / this.row);
		this.layout();
		this.scroller.width( this.total * this.itemW );
		if( n === 'first' ){ n = 0 }
		this.goTo(n);
		if( this.pagingNav.length ) { this.initPaging(); }
		this.setBtnStatus();
	}
}
function Tabs(ele,opts){
	var defaults = {
		nav: 'ul.tab_nav',
		mask:'div.tab_mask',
		speed: 70,
		items: 'div.tab_item',
		scroll: 'div.tab_scroll',
		fixedHeight: false,
		autosize:false,
		animation:false,
		startTab:0,
		callback:false,
		initCb: false
	}
	var o = $.extend({},defaults,opts);
	this.opts = o;
	this.ele = ele;
	this.nav = ele.find(o.nav);
	this.navItems = this.nav.find('a');
	this.scroll = ele.find(o.scroll);
	this.items = ele.find(o.items);
	this.mask = ele.find(o.mask);
	this.tabs = [];

	this.init();
}
Tabs.prototype = {
	init: function(){
		var t = this;
		this.layout();
		this.navItems.each(function(i){
			var $t = $(this);
			$t.data({id:i}).click(function(){
				t.goTo( $t.data().id );return false;
			});
		});
		this.goTo(this.opts.startTab);
		this.opts.initCb ? this.opts.initCb(this) : '';
	},
	layout:function(){
		var t = this;
		this.scroll.width( (t.mask.width()) * t.items.length);
		this.items.each(function(i){
			t.tabs[i] = {ele:$(this),id:this.id,index:i};
		}).css({float:'left'}).width(t.mask.width());

		if(this.opts.autosize){
			this.navItems.each(function(i){
				var $t = $(this), m = parseInt($t.parent().css('marginLeft'));
				$t.width( (t.ele.width()/t.items.length) - m ).css({paddingLeft:0,paddingRight:0})
			})
		}
	},
	goTo: function(n){
		var target = this.tabs[n].ele;
		this.scroll[0].style.left = -target.position().left+'px';
		this.current = target;
		this.index = parseInt(n);
		this.setActive();
		!this.opts.fixedHeight ? this.setHeight(false, this.opts.callback) : '';
	},
	setActive: function(){
		var t = this;
		this.navItems.removeClass('active').filter(':eq('+t.index+')').addClass('active');		
	},
	setHeight: function(h,cb){
		this.current.height('auto');
		var h = h || this.current.height(), t = this;
		this.mask.animate({height:h+'px'},t.opts.speed);
		cb ? cb(this) : '';
	},
	reSize:function(){
		this.layout();
		this.goTo(this.index);
		//this.setHeight();
	}
}

// Globals -------------
function scrollToPoint(id,offset,speed){
	var speed = speed || 600, o = offset || 0;
	var ele = typeof(id) === 'object' ? id : jQuery('#'+id);
	jQuery("html, body").animate({scrollTop: ele.offset().top-o}, speed);
}

// jQuery fn wrappers -----------------
!function($){
	$.fn.slider = function(opts){
		return this.each(function(){
			$(this).data().slider = new Slider($(this),opts);
		});
	}
	$.fn.tabs = function(opts){
		return this.each(function(){
			$(this).data().tabs = new Tabs($(this),opts);
		});
	}
}(jQuery);