(function(a){Drupal.color={callback:function(b,c,d,e,f,g){a("#preview",d).css("backgroundColor",a('#palette input[name="palette[base]"]',d).val()),a("#text",d).css("color",a('#palette input[name="palette[text]"]',d).val()),a("#text a, #text h2",d).css("color",a('#palette input[name="palette[link]"]',d).val());var h,k;for(i in c.gradients){h=e.unpack(a('#palette input[name="palette['+c.gradients[i].colors[0]+']"]',d).val()),k=e.unpack(a('#palette input[name="palette['+c.gradients[i].colors[1]+']"]',d).val());if(h&&k){var l=[];for(j in h)l[j]=(k[j]-h[j])/(c.gradients[i].vertical?f[i]:g[i]);var m=h;a("#gradient-"+i+" > div",d).each(function(){for(j in m)m[j]+=l[j];this.style.backgroundColor=e.pack(m)})}}}}})(jQuery);