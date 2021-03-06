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
								<div class="col-sm-12 padding00"> 
									<a href="{{ $img->big }}" class="news-box-link " rel="prettyPhoto[news]" title="{{ $img->desc }}">
										<img class="news-box-image" src="{{ $img->big }}">
									</a>
								</div>
								<div class="col-sm-12"> 

									<p class="thumb_date"> <span class="glyphicon glyphicon-time"></span> {{ BaseController::localDate($n->created_at) }}</p>
									<a href="{{ route('categories.articles.show', [$n->category, $n->id]) }}"><div class="thumb_article">{{$n->desc}}</div></a>
								</div>
							</div>
						</div>