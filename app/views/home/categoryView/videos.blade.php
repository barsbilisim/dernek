						<div class="news-box-block">
							<div class="timeline-icon col-sm-2">
								<div>
								<p><span class="glyphicon glyphicon-{{ $n->getCategoryIcon() }}"></span></p>
								</div>
								<span class="dotted-horizon"></span>

								<span class="circle-outer"></span>
								<span class="circle-inner"></span>
							</div>
							<div class="thumbnail col-md-10 kdmk-{{ $n->getCategoryIcon() }}">
								<div class="col-sm-12 padding00"> 
									<div class="video-container">
									
									<iframe width="560" height="315" src="//www.youtube.com/embed/{{ $n->getVideo($n->content)}}?wmode=transparent" frameborder="0" allowfullscreen></iframe>
									</div>
								
								</div>
								<div class="col-sm-12"> 

									<div class="thumb_date"> <span class="glyphicon glyphicon-time"></span> {{ BaseController::localDate($n->created_at) }}</div>
								</div>
							</div>
						</div>
