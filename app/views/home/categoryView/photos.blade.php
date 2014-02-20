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
							<a href="{{ route('categories.articles.show', [$n->category, $n->id]) }}"><p class="thumb_text">{{{ $n->title }}}</p></a>
								<div class="col-sm-12 padding00 mainGallery">
								<ul> 
									@foreach($n->getGallery() as $image)
									<li><a href="{{{ $image->big() }}}" rel="prettyPhoto[front-page]" title="{{{ $image->desc() }}}" class="crop">
										<div style="background-image:url({{{ $image->thumb() }}});"class="imageOnMail"></div>
									</a></li>

									@endforeach
								</ul>
								</div>
								<div class="col-sm-12"> 

									<div class="thumb_date"> <span class="glyphicon glyphicon-time"></span> {{ BaseController::localDate($n->created_at) }}</div>
								</div>
							</div>
						</div>