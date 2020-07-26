<div class="col-md-12">
                                <div style="8px; color: #0062cc;">
                                    <h6>Gallery</h6>
                                </div>
                                <?php
                                 $qry ="SELECT * FROM user_galerry WHERE u_id='$uid'";
                                    if($result1 = $conn->query($qry)) 
                                    {
                                        
                                        if($r2=$result1->fetch_row())
                                        {
                                            $nrow=mysqli_num_fields($result1);
                                            $n=1;
                                            $count=0;
                                            while($n < $nrow && $count <=6)
                                            {
                                             echo "<img id='' src='uploads/gallery/$r2[$n]' style='width: 25%; padding: 3px;' onclick='openModal();currentSlide(1)'>";
                                             $n++;
                                             $count++;
                                            
                                            }

                                        }
                                        else
                                        {
                                            echo "errr";
                                        }
                                    }
                                    else
                                    {
                                      echo "eRROR";
                                    } 
                                ?>
                               
                                <div id="myModal" class="modal">
                                  <span class="close cursor" onclick="closeModal()">&times;</span>
                                  <div class="modal-content">

                                    <div class="mySlides">
                                      <div class="numbertext">1 / 4</div>
                                      <img src="uploads/gallery/<?php $r2["$n"]; ?>" style="width:100%">
                                    </div>

                                    <div class="mySlides">
                                      <div class="numbertext">2 / 4</div>
                                      <img src="img_snow_wide.jpg" style="width:100%">
                                    </div>

                                    <div class="mySlides">
                                      <div class="numbertext">3 / 4</div>
                                      <img src="img_mountains_wide.jpg" style="width:100%">
                                    </div>
                                    
                                    <div class="mySlides">
                                      <div class="numbertext">4 / 4</div>
                                      <img src="img_lights_wide.jpg" style="width:100%">
                                    </div>
                                    
                                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                                    <a class="next" onclick="plusSlides(1)">&#10095;</a>

                                    <div class="caption-container">
                                      <p id="caption"></p>
                                    </div>


                                    
                                  </div>
                                </div>

                                <script>
                                function openModal() {
                                  document.getElementById("myModal").style.display = "block";
                                }

                                function closeModal() {
                                  document.getElementById("myModal").style.display = "none";
                                }

                                var slideIndex = 1;
                                showSlides(slideIndex);

                                function plusSlides(n) {
                                  showSlides(slideIndex += n);
                                }

                                function currentSlide(n) {
                                  showSlides(slideIndex = n);
                                }

                                function showSlides(n) {
                                  var i;
                                  var slides = document.getElementsByClassName("mySlides");
                                  var dots = document.getElementsByClassName("demo");
                                  var captionText = document.getElementById("caption");
                                  if (n > slides.length) {slideIndex = 1}
                                  if (n < 1) {slideIndex = slides.length}
                                  for (i = 0; i < slides.length; i++) {
                                      slides[i].style.display = "none";
                                  }
                                  for (i = 0; i < dots.length; i++) {
                                      dots[i].className = dots[i].className.replace(" active", "");
                                  }
                                  slides[slideIndex-1].style.display = "block";
                                  dots[slideIndex-1].className += " active";
                                  captionText.innerHTML = dots[slideIndex-1].alt;
                                }
                                </script>
                 </div>